<?php

namespace App\Http\Controllers;

use App\Models\Configurator;
use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class orderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //pobranie session z koszykiem
        $cart = session()->get('cart');
        //pobranie rabatu
        $discount = session()->get('discount');
        $totalPrice = 0;

        if ($cart == null){
            return view('configurator.configurator', [
                'configurators' => Configurator::all()
              ]);
        } else {

            foreach ($cart as $value) {
                $totalPrice += $value['productPrice'] * $value['productQuantity'];
            }
            
            //wysłanie ceny do session
            session()->push('orderPrice', $totalPrice);
            session()->save();

            if (empty($discount)) {
                $discount[] = 0;
            }

            return view('order.order')->with([
                'orderPrice' => $totalPrice,
                'discount' => $discount[0]
            ]);
        }
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function discount(Request $request)
    {
        //uwierzytelnienie tokena
        $token = $request->session()->token();
        $token = csrf_token();

        $data = $request->all();
        $value = 0;
        $orderPrice = session()->get('orderPrice');

        //pobieram rabat
        $coupon = Discount::select('amount', 'discount_type')
            ->where('discount_code', $data['coupon'])
            ->where('active', 'Y')->first();

        if (!isset($coupon->amount) || !isset($coupon->discount_type)){
            return redirect('/orderSummary')->with('errorDiscount', 'Nie ma takiego kuponu');
        } else {
            
            if ($coupon->discount_type == 'Percent'){

                $value = $orderPrice[0] * $coupon->amount / 100;

                session()->push('discount', $value);
                session()->save();

            } elseif ($coupon->discount_type == 'Value'){

                //wysłanie rabatu do session
                session()->push('discount', $coupon->amount);
                session()->save();
            }

            //zmiana -kupon przestaje być aktywny
            Discount::where('discount_code', $data['coupon'])->update(array('active' => 'N'));
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addOrder(Request $request)
    {
        //uwierzytelnienie tokena
        $token = $request->session()->token();
        $token = csrf_token();

        //pobranie session z koszykiem
        $cart = session()->get('cart');
        $technicalData = '';
        //pobranie rabatu
        $discount = session()->get('discount');
        //pobranie ceny
        $orderPrice = session()->get('orderPrice');
        //id użytkownika
        $userId = Auth::id();

        //dodanie wszystkiego do zmiennej
        $data = $request->only([
            'surname', 
            'phone_number', 
            'address', 
            'house_number', 
            'city', 
            'zip_code', 
            'province',
            'payment_method'
        ]);
        //sprawdzenie czy dane są uzupełnione
        foreach ($data as $value) {
            if (empty($value)) {
                return redirect()->back();
            }
        }
        //sprawdzenie czy klient posiada rabat
        if (!empty($discount)) {
            $orderPrice[0] -= $discount[0];
        }
        //dodanie adresu do bazy
        Address::create([
            'userID' => $userId,
            'last_name' => $data['surname'],
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
            'house_number' => $data['house_number'],
            'zip_code' => $data['zip_code'],
            'city' => $data['city'],
            'province' => $data['province'],
        ]);
        //dodanie zamówienia do bazy
        $orderId = Order::create([
            'userID' => $userId,
            'order_price' => $orderPrice[0],
            'status' => 'Oczekuje na wpłatę',
            'payment_method' => $data['payment_method'],
        ])->id;

        foreach ($cart as $product) {

            Product::create([
                'orderID' => $orderId,
                'description' => $product['productName'],
                'quantity' => $product['productQuantity'],
                'product_price' => $product['productPrice'],
                'technical_data' => $product['technicalData'],
            ]);
        }

        Session()->forget('cart');
        Session()->forget('discount');
        Session()->forget('orderPrice');

        return view('order.orderCompleted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
