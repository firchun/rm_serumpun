@extends('layouts.backend.admin')

@section('content')
    <section class="pc-container">

        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            @include('layouts.backend.title')
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- subscribe start -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Tambah Menu</h5>
                                    {{-- {{ 'INV-' . substr(date('Y'), -2) . date('mdhis') }} --}}
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('foods.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group ">
                                            <label>Foto Menu</label>
                                            <input type="file" class="form-control" name="thumbnail">
                                            <small>Upload gambar jika ingin perbarui</small>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Menu <span class="text-danger">*</span></label>
                                            <input type="text" name="name" placeholder="Nama Menu"
                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Harga <span class="text-danger">*</span></label>
                                            <input type="number" name="price" placeholder="Harga" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea name="description" class="form-control"></textarea>
                                        </div>

                                        <button type="submit" class="btn  btn-primary">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5>{{ $title }}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped mb-0 lara-dataTable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Foto</th>
                                                    <th>Nama Menu</th>
                                                    <th>Harga</th>
                                                    <th>Tampilkan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($food_menu as $item)
                                                    <tr>
                                                        <td width="10">{{ $loop->iteration }}</td>
                                                        <td width="150">
                                                            <div class="thumbnail">
                                                                <div class="thumb">
                                                                    <a href="{{ $item->thumbnail == '' ? asset('img/no-image.png') : url(Storage::url($item->thumbnail)) }}"
                                                                        data-lightbox="1" data-title="{{ $item->name }}"
                                                                        data-toggle="lightbox">
                                                                        <img src="{{ $item->thumbnail == '' ? asset('img/user.png') : url(Storage::url($item->thumbnail)) }}"
                                                                            alt="{{ $item->name }}"
                                                                            class="img-fluid img-avatar" width="100">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <strong>{{ $item->name }}</strong>
                                                            <br>
                                                            <small
                                                                class="text-muted">{{ Str::limit($item->description, 100) }}</small>
                                                        </td>
                                                        <td>
                                                            <span class="text-danger">
                                                                Rp {{ number_format($item->price) }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            {!! $item->active == 1
                                                                ? '<span class="badge badge-primary">Tampil</span>'
                                                                : '<span class="badge badge-danger">Tidak</span>' !!}
                                                        </td>
                                                        <td width="200">

                                                            <button type="button" class="btn btn-light-warning btn-md"
                                                                data-toggle="modal"
                                                                data-target=".edit-{{ $item->id }}"><i
                                                                    class="icon feather icon-edit f-16"></i>
                                                            </button>
                                                            @include('admin.food_menu.components.modal_edit')
                                                            <form method="POST"
                                                                action="{{ route('foods.destroy', $item->id) }}"
                                                                class="d-inline-block">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-light-danger btn-md delete-button"><i
                                                                        class="feather icon-trash-2  f-16 "></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- subscribe end -->
                </div>
                <!-- [ Main Content ] end -->
            </div>
    </section>
@endsection
