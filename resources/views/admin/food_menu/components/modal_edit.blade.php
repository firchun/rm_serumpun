<div class="modal fade edit-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('foods.update', $item->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form">
                        <div class="form-group">
                            <center>
                                <img src="{{ $item->thumbnail == '' ? asset('img/default.jpg') : url(Storage::url($item->thumbnail)) }}"
                                    alt="" width="200">
                            </center>
                            <br>
                            <label>Foto Menu</label>
                            <input type="file" class="form-control" name="thumbnail">
                            <small>Upload gambar jika ingin perbarui</small>
                        </div>
                        <div class="form-group">
                            <label>Nama Menu <span class="text-danger">*</span></label>
                            <input type="text" name="name" placeholder="Nama Menu" class="form-control"
                                value="{{ $item->name }}">
                        </div>
                        <div class="form-group">
                            <label>Harga <span class="text-danger">*</span></label>
                            <input type="number" name="price" placeholder="Harga" class="form-control"
                                value="{{ $item->price }}">
                        </div>
                        <div class="form-group">
                            <label>Tampilkan </label>
                            <select name="active" class="form-control">
                                <option value="1" @if ($item->active == 1) selected @endif>Tampilkan
                                </option>
                                <option value="0" @if ($item->active == 0) selected @endif>Sembunyikan
                                </option>
                            </select>

                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="description" class="form-control">{{ $item->description }}</textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn  btn-primary">Simpan perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script src="{{ asset('admin_theme') }}/assets/plugins/ckeditor/ckeditor.js"></script>
    <!-- CKEditor -->
    <script src="{{ asset('admin_theme') }}/assets/plugins/ckeditor/ckeditor.js"></script>
@endpush
