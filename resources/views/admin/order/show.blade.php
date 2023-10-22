@extends('layouts.backend.admin')

@section('content')
    <section class="pc-container">

        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            @include('layouts.backend.title')
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                @php
                    $paid_off = App\Models\OrderPaidOff::where('id_order', $order->id);
                @endphp
                @if ($paid_off->count() == 0)
                    <div class="col-12">
                        <div class="alert alert-danger form-inline" role="alert">
                            Pesanan belum lunas
                            @if (Auth::user()->role == 'admin')
                                ,
                                <form action="{{ route('orders.lunas') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id_order" value="{{ $order->id }}">
                                    <button type="submit" class="btn btn-sm btn-success">Verifikasi pelunasan</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="col-12">
                        <div class="alert alert-success " role="alert">
                            Pesanan ini telah terkonfirmasi lunas oleh : {{ $paid_off->latest()->first()->user->name }}
                        </div>
                    </div>
                @endif
                <!-- subscribe start -->
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5>Detail Pelanggan</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <td>Nama</td>
                                    <td>{{ $order->user->name }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>{{ $order->user->address }}</td>
                                </tr>
                                <tr>
                                    <td>No. Hp</td>
                                    <td>{{ $order->user->phone }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5>Pembayaran</h5>
                        </div>
                        <div class="card-body">
                            @php
                                $payment = App\Models\OrderPayment::where('id_order', $order->id)->get();
                            @endphp
                            @if (Auth::user()->role == 'admin')
                                <button type="button" class="btn btn-success btn-md mb-3 btn-round btn-block"
                                    data-toggle="modal" data-target=".bayar"><i class="feather f-16 icon-plus"></i>
                                    Tambah</button>
                                <hr>
                            @endif
                            <div class="my-3 table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Bukti</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payment as $item)
                                            <tr>
                                                <td width="150">
                                                    <div class="thumbnail">
                                                        <div class="thumb">
                                                            <a href="{{ $item->thumbnail == '' ? asset('img/no-image.jpg') : url(Storage::url($item->thumbnail)) }}"
                                                                data-lightbox="1" data-title="{{ $item->invoice }}"
                                                                data-toggle="lightbox">
                                                                <img src="{{ $item->thumbnail == '' ? asset('img/no-image.jpg') : url(Storage::url($item->thumbnail)) }}"
                                                                    alt="{{ $item->invoice }}" class="img-fluid img-avatar"
                                                                    width="100">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                                @if (Auth::user()->role == 'admin')
                                                    <td class="text-right">
                                                        <form action="{{ route('orders.destroyPayment', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-light-danger delete-button">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ $title }}</h5>
                        </div>
                        <div class="card-body">
                            @if (Auth::user()->role == 'admin')
                                <div class="row align-items-center m-l-0">
                                    <div class="col-sm-6">
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <button type="button" class="btn btn-success btn-md mb-3 btn-round"
                                            data-toggle="modal" data-target=".tambah"><i class="feather f-16 icon-plus"></i>
                                            Tambah</button>
                                    </div>
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mb-0 lara-dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Pesanan</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            @if (Auth::user()->role == 'admin')
                                                <th></th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order_items as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->sum }}</td>
                                                <td>Rp {{ number_format($item->price) }}</td>
                                                @if (Auth::user()->role == 'admin')
                                                    <td>
                                                        <form action="{{ route('orders.destroyItems', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-light-danger delete-button">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if (Auth::user()->role == 'admin')
        {{-- modal create  --}}
        @include('admin.order.components.modal_bayar')
        @include('admin.order.components.modal_pesan')
    @endif
@endsection
