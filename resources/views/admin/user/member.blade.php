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
                                            <th>Avatar</th>
                                            <th>Nama Akun</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user as $item)
                                            <tr>
                                                <td width="10">{{ $loop->iteration }}</td>
                                                <td width="150">
                                                    <div class="thumbnail">
                                                        <div class="thumb">
                                                            <a href="{{ $item->avatar == '' ? asset('img/user.png') : url(Storage::url($item->avatar)) }}"
                                                                data-lightbox="1" data-title="{{ $item->judul }}"
                                                                data-toggle="lightbox">
                                                                <img src="{{ $item->avatar == '' ? asset('img/user.png') : url(Storage::url($item->avatar)) }}"
                                                                    alt="{{ $item->judul }}" class="img-fluid img-avatar"
                                                                    width="50">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ $item->name }}<br>
                                                    <p class="text-muted">{{ $item->email }}</p>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
