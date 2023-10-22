<div class="modal fade tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Tambah Pesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('orders.storeItems') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="hidden" name="id_order" value="{{ $order->id }}">
                    <div class="row " id="data_pesanan">
                        <div class="col-lg-4">
                            <label>Nama Pesanan</label>
                            <input type="text" name="name[]" class="form-control" placeholder="Nama">
                        </div>
                        <div class="col-lg-2">
                            <label>Jumlah </label>
                            <input type="number" name="sum[]" class="form-control" value="1">
                        </div>
                        <div class="col-lg-4">
                            <label>Harga Pesanan (Rp)</label>
                            <input type="number" name="price[]" class="form-control">
                        </div>
                        <div class="col-lg-2">
                            <button type="button" class="btn btn-light-primary mt-4 add-button"><i
                                    class="fa fa-plus"></i></button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dataPesanan = document.getElementById('data_pesanan');

            // Fungsi untuk menambah form pesanan
            function addPesanan() {
                const newRow = document.createElement('div');
                newRow.classList.add('row', 'my-2', 'mx-2');

                newRow.innerHTML = `
                <div class="col-lg-4">
                    <label>Nama Pesanan</label>
                    <input type="text" name="name[]" class="form-control" placeholder="Nama">
                </div>
                <div class="col-lg-2">
                    <label>Jumlah </label>
                    <input type="number" name="sum[]" class="form-control" value="1">
                </div>
                <div class="col-lg-4">
                    <label>Harga Pesanan (Rp)</label>
                    <input type="number" name="price[]" class="form-control">
                </div>
                <div class="col-lg-2">
                    <button type="button" class="btn btn-danger mt-4 remove-button"><i class="fa fa-minus"></i></button>
                </div>
            `;

                dataPesanan.appendChild(newRow);

                // Menambahkan event listener untuk tombol hapus
                const removeButtons = document.querySelectorAll('.remove-button');
                removeButtons.forEach(button => {
                    button.addEventListener('click', removePesanan);
                });
            }

            // Fungsi untuk menghapus form pesanan
            function removePesanan() {
                const row = this.closest('.row');
                row.remove();
            }

            // Menambahkan event listener untuk tombol tambah
            const addButton = document.querySelector('.add-button');
            addButton.addEventListener('click', addPesanan);
        });
    </script>
    <script src="{{ asset('admin_theme') }}/assets/plugins/ckeditor/ckeditor.js"></script>
    <!-- CKEditor -->
    <script src="{{ asset('admin_theme') }}/assets/plugins/ckeditor/ckeditor.js"></script>
@endpush
