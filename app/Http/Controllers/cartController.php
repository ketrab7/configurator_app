<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Configurator;
use App\Models\Module;

class cartController extends Controller
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
        if ($cart == null){
            $cart = [];
        }

        return view('cart.cart')->with('cart', $cart);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request)
    {
        $ConfiguratorID = $request->input('ConfiguratorID');
        $technicalDataProduct = '';
        $price = 0;
        
        //select - pobieram wszystkie atrybuty dla danego konfiguratora
        $module = DB::table('modules')->select('name', 'title', 'type', 'value', 'priceFactor')->where('configuratorID', '=', $ConfiguratorID)->get();
        $modules = $module->all();

        //uwierzytelnienie tokena
        $token = $request->session()->token();
        $token = csrf_token();

        //dodanie wszystkiego do zmiennej
        $data = $request->all();

        //sprawdzenie poprawnosci danych które zeszły z module
        foreach ($modules as $items){//break przerywa działanie petli a continue przerywa daną iterację petli

            if (isset($data[$items->name]) || $items->type == 'text'){
                switch($items->type) {
                    case 'string':
                        $price *= $items->priceFactor;
                        $technicalDataProduct .= '"'.$items->name.'":"'.$data[$items->name].'"';
                        break;

                    case 'text':
                        $price *= $items->priceFactor;
                        $technicalDataProduct .= '"'.$items->name.'":"'.$data[$items->name].'"';
                        break;

                    case 'integer':
                        if (is_numeric($data[$items->name]) && $data[$items->name] > 0) {
                            //przeliczamy cene
                            $price += $items->priceFactor * $data[$items->name];
                            $technicalDataProduct .= '"'.$items->name.'":"'.$data[$items->name].'"';
                        } else {
                            $message = 'Wartość w polu numerycznym jest niepoprawna, spróbuj ponownie skonfigurować produkt.';
                            goto error;
                        }            
                        break;

                    case 'select':
                        $selectOptions = explode(';', $items->value);

                        if (in_array($data[$items->name], $selectOptions)) {
                            $price *= $items->priceFactor;
                            $technicalDataProduct .= '"'.$items->name.'":"'.$data[$items->name].'"';
                        } else {
                            $message = 'Nie ma takiej opcji w polu wyboru, spróbuj ponownie skonfigurować produkt';
                            goto error;
                        }
                        break;

                    default:
                        $message = 'Coś poszło nie tak, spróbuj ponownie skonfigurować produkt';
                        goto error;
                }
            } else {
                $message = 'Coś poszło nie tak, spróbuj ponownie skonfigurować produkt';
                goto error;
            }
        }
        if ($data['productPrice'] == $price || ($data['productPrice']/$price) > 0.95 || ($data['productPrice']/$price) < 1.05 ){
            
        } else {
            $message = 'Coś poszło nie tak, spróbuj ponownie skonfigurować produkt';
            goto error;
        }    
        
        $data['modules'] = $modules; 
        $data['technicalData'] = $technicalDataProduct;

        //wysłanie wszystkiego do session koszyka
        $request->session()->push('cart', $data);
        session()->save();
        
        //przekierowanie na configurator i aktywacja toast
        return redirect('configurator')->with('toast', true);

        //powrót na stronę i wygenerowanie błędu
        error:
            return redirect()->back()->with('status', $message);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request)
    {
        if($request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["productQuantity"] = $request->quantity;
            session()->put('cart', $cart);
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //wyczyszczenie Cart
        Session()->forget('cart');
        Session()->forget('discount');
        Session()->forget('orderPrice');

        //powrót na stronę
        return redirect()->back();
    }
}
