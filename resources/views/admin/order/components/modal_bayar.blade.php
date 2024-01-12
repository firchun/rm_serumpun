<div class="modal fade bayar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Bayar Pesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('orders.storePayment') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="hidden" name="id_order" value="{{ $order->id }}">
                    <div class="form-group ">
                        <label>Foto Bukti Pembayaran</label>
                        <input type="file" class="form-control" name="thumbnail">
                    </div>
                    <div class="form-group">
                        <label>Jumlah Pembayaran <span class="text-danger">*</span></label>
                        <input type="number" name="paid" class="form-control" value="0">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
