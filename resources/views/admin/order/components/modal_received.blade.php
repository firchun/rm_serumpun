<div class="modal fade received-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Konfirmasi Pengambilan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('orders.storeReceived') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="hidden" name="id_order" value="{{ $item->id }}">
                    <div class="form-group">
                        <label>Nama pengambil <span class="text-danger">*</span></label>
                        <input type="text" name="recipent" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Konfirmasi</button>
                </form>
            </div>
        </div>
    </div>
</div>
