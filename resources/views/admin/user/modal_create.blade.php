<div class="modal fade tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ url('/user/store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="role" value="kasir">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Avatar</label>
                            <input type="file" class="form-control" name="avatar">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" name="name" placeholder="Nama Lengkap"
                                required>
                        </div>
                        <div class="form-group col-md-8">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="email" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Nomor Handphone</label>
                            <input type="number" class="form-control" name="phone" placeholder="Nomor Handphone"
                                required>
                        </div>
                    </div>
                    <button type="submit" class="btn  btn-primary">Simpan</button>
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
