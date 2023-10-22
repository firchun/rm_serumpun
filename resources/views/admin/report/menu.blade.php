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
                            <div class="row align-items-center m-l-0 mb-2">
                                <div class="col-sm-6">
                                </div>
                                <div class="col-sm-6 text-right">
                                    <a class="btn btn-primary" href="{{ route('report.pdf_menu') }}" target="__blank"><i
                                            class="feather f-16 icon-printer"></i>
                                        Cetak Laporan</a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mb-0 lara-dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Foto</th>
                                            <th>Nama Menu</th>
                                            <th>Harga</th>
                                            <th>Tampilkan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($menu as $item)
                                            <tr>
                                                <td width="10">{{ $loop->iteration }}</td>
                                                <td width="150">
                                                    <div class="thumbnail">
                                                        <div class="thumb">
                                                            <a href="{{ $item->thumbnail == '' ? asset('img/no-image.png') : url(Storage::url($item->thumbnail)) }}"
                                                                data-lightbox="1" data-title="{{ $item->name }}"
                                                                data-toggle="lightbox">
                                                                <img src="{{ $item->thumbnail == '' ? asset('img/user.png') : url(Storage::url($item->thumbnail)) }}"
                                                                    alt="{{ $item->name }}" class="img-fluid img-avatar"
                                                                    width="100">
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
                                                    {!! $item->active == 1 ? '<span class=" text-primary">Tampil</span>' : '<span class=" text-danger">Tidak</span>' !!}
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <!-- subscribe end -->
                </div>
                <!-- [ Main Content ] end -->
            </div>
    </section>
@endsection
