@extends('layouts.backand_theme.admin')

@section('content')
    <div class="pc-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            @include('layouts.backand_theme.title')
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Edit User</h5>

                        </div>
                        <div class="card-body">
                            @if (Session::has('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('success') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                @foreach ($errors->all() as $item)
                                    <div class="alert alert-danger" role="alert">
                                        {{ $item }}
                                    </div>
                                @endforeach
                            @endif
                            <form method="POST" action="{{ route('user.update', $user->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <img src="{{ $user->avatar == '' ? asset('img/default.jpg') : url(Storage::url($user->avatar)) }}"
                                            alt="" width="200">
                                        <br>
                                        <label>Avatar</label>
                                        <input type="file" class="form-control" name="avatar">
                                        <small>Upload gambar jika ingin perbarui</small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Username</label>
                                        <input type="text" class="form-control" name="username" placeholder="username"
                                            value="{{ $user->username }}" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Password">
                                        <small>Kosongkan jika tidak dirubah</small>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Nama Lengkap</label>
                                        <input type="text" class="form-control" name="name" placeholder="Nama Lengkap"
                                            value="{{ $user->name }}" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="email"
                                            value="{{ $user->email }}" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Nomor Handphone</label>
                                        <input type="number" class="form-control" name="phone"
                                            placeholder="Nomor Handphone" value="{{ $user->phone }}" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn  btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
@endsection
