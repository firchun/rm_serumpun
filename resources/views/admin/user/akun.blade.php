@extends('layouts.backend.admin')

@section('content')
    <div class="pc-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            @include('layouts.backend.title')
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-lg-4">
                    <div class="card user-card user-card-1">
                        <div class="card-body pb-0">
                            <div class="media user-about-block align-items-center mt-0 mb-3">
                                <div class="position-relative d-inline-block">
                                    <img class="img-radius img-fluid wid-80"
                                        src="{{ $user->avatar == '' ? asset('img/user.png') : url(Storage::url($user->avatar)) }}"
                                        alt="User image">
                                    <div class="certificated-badge">
                                        <i class="fas fa-certificate text-primary bg-icon"></i>
                                        <i class="fas fa-check front-icon text-white"></i>
                                    </div>
                                </div>
                                <div class="media-body ml-3">
                                    <h6 class="mb-1">{{ $user->name }}</h6>
                                    <p class="mb-0 text-muted">{{ $user->role }}</p>
                                </div>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <span class="f-w-500"><i class="feather icon-mail m-r-10"></i>Email</span>
                                <a href="{{ $user->email }}" class="float-right text-body">{{ $user->email }}</a>
                            </li>
                            <li class="list-group-item">
                                <span class="f-w-500"><i class="feather icon-phone-call m-r-10"></i>Phone</span>
                                <a href="#" class="float-right text-body">{{ $user->phone }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="tab-content" id="user-set-tabContent">
                        <div class="tab-pane fade show active" id="user-set-profile" role="tabpanel"
                            aria-labelledby="user-set-profile-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h5><i data-feather="user" class="icon-svg-primary wid-20"></i><span
                                            class="p-l-5">Profil Akun</span></h5>
                                </div>
                                <div class="card-body">
                                    <h5 class="mb-3">Perbarui Data</h5>
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
                                                <img src="{{ $user->avatar == '' ? asset('img/default.png') : url(Storage::url($user->avatar)) }}"
                                                    alt="" width="200">
                                                <br>
                                                <label>Avatar</label>
                                                <input type="file" class="form-control" name="avatar">
                                                <small>Upload gambar jika ingin perbarui</small>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label>Username</label>
                                                <input type="text" class="form-control" name="username"
                                                    placeholder="username" value="{{ $user->username }}" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Password</label>
                                                <input type="password" class="form-control" name="password"
                                                    placeholder="Password">
                                                <small>Kosongkan jika tidak dirubah</small>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Nama Lengkap</label>
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Nama Lengkap" value="{{ $user->name }}" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name="email"
                                                    placeholder="email" value="{{ $user->email }}" required>
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
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
@endsection
