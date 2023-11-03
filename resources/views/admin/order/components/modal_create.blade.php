<div class="modal fade tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Tambah Pesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('orders.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-group ">
                        <label>Foto Menu</label>
                        <input type="file" class="form-control" name="thumbnail">
                        <small>Upload gambar jika ingin perbarui</small>
                    </div>
                    <div class="form-group">
                        <label>Pilih Pelanggan</label>
                        <select name="id_user" class="form-control">
                            @foreach (App\Models\User::where('role', 'user')->get() as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <hr>
                    <div class="border border-primary p-2 rounded">
                        <h5>Pesanan</h5>
                        <div class="row " id="data_pesanan">
                            <div class="col-lg-4">
                                <label>Nama Pesanan</label>
                                <input type="text" name="name[]" class="form-control" placeholder="Nama">
                            </div>
                            <div class="col-lg-2">
                                <label>Jumlah </label>
                                <input type="number" name="sum[]" class="form-control" value="1">
                            </div>
                            <div class="col-lg-2">
                                <label>Satuan </label>
                                <select name="unit[]" class="form-control">
                                    <option value="Bungkus">Bungkus</option>
                                    <option value="Porsi">Porsi</option>
                                    <option value="Kotak">Kotak</option>
                                    <option value="Plastik">Plastik</option>
                                    <option value="Pcs">Pcs</option>
                                    <option value="Botol">Botol</option>
                                    <option value="Gelas">Gelas</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
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
                <div class="col-lg-2">
                    <label>Satuan </label>
                    <select name="unit[]" class="form-control">
                        <option value="Bungkus">Bungkus</option>
                            <option value="Porsi">Porsi</option>
                            <option value="Kotak">Kotak</option>
                            <option value="Plastik">Plastik</option>
                            <option value="Pcs">Pcs</option>
                            <option value="Botol">Botol</option>
                            <option value="Gelas">Gelas</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
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
