@foreach ($cart as $key => $item)
    <!-- Modal -->
    <div class="modal fade" id="exampleModal{{ $key }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Podgląd produktu</h5>
                    <button type="button" class="close close-btn" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table bordered">
                    @foreach ($item['modules'] as $module)
                        <tr class="col-xs-12">
                            <td>
                                <span class="pt-1 pb-1"><b>{{ $module->title }}:</b></span>&nbsp;
                            </td>
                            <td>
                                <span class="pt-1 pb-1">{{ $item[$module->name] }}</span>
                            </td>
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endforeach