<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Podsumowanie</h5>
        <button type="button" class="close close-btn" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <table>
                <tr>
                    <td>
                        <b>Nazwa produktu:</b>&nbsp;
                    </td>
                    <td>
                        <input type="text" class="form-control m-2" id="productName" name="productName" readonly>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Cena produktu:</b>&nbsp;
                    </td>
                    <td>
                        <input type="number" class="form-control m-2" id="productPrice" name="productPrice" readonly>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Ilość sztuk:</b>&nbsp;
                    </td>
                    <td>
                        <input type="number" class="form-control m-2" id="productQuantity" name="productQuantity" value="1">
                    </td>
                </tr>
            </table>
        </div>
        <div class="modal-footer">
        <!-- button for placing an order -->
        <button type="submit" class="btn btn-secondary">Koszyk</button>
        </div>
    </div>
    </div>
</div>