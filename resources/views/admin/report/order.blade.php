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
                <div class="col-12 my-3">
                    <form action="{{ route('report.pdf_orders') }}" method="GET">
                        <div class="form-inline">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Tanggal</span>
                                </div>
                                <input type="date" name="from_date" class="form-control" value="{{ date('Y-m-d') }}">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Sampai</span>
                                </div>
                                <input type="date" name="to_date" class="form-control"
                                    value="{{ date('Y-m-d', strtotime('+1 month')) }}">
                            </div>
                            <select name="pembayaran" class="form-control mx-2">
                                <option value="semua" selected>Semua</option>
                                <option value="lunas">Lunas</option>
                                <option value="belum-lunas">Belum Lunas</option>
                            </select>
                            <button type="submit" class="btn btn-primary"><i class="feather f-16 icon-printer"></i>
                                Cetak laporan</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ $title }}</h5>
                        </div>
                        <div class="card-body">
                            {{-- <div class="row align-items-center m-l-0 mb-2">
                                <div class="col-sm-6">
                                </div>
                                <div class="col-sm-6 text-right">
                                    <a class="btn btn-primary" href="{{ route('report.pdf_orders') }}" target="__blank"><i
                                            class="feather f-16 icon-printer"></i>
                                        Cetak Laporan</a>
                                </div>
                            </div> --}}
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mb-0 lara-dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Foto</th>
                                            <th>No. Invoice</th>
                                            <th>Pesanan</th>
                                            <th>tagihan</th>
                                            <th>Pembayaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order as $item)
                                            <tr>
                                                <td width="10">{{ $loop->iteration }}</td>
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
                                                <td>
                                                    <strong>{{ $item->invoice }}</strong>
                                                    <br>
                                                    <small
                                                        class="text-muted">{{ Str::limit($item->description, 100) }}</small>
                                                </td>
                                                <td>
                                                    @php
                                                        $order_item = App\Models\OrderItem::where('id_order', $item->id)->get();
                                                        $total_price = $order_item->sum(function ($orderItem) {
                                                            return $orderItem->sum * $orderItem->price;
                                                        });
                                                        // dd($order_item->sum('sum * price'));
                                                    @endphp
                                                    <ol>
                                                        @foreach ($order_item as $list)
                                                            <li>{{ $list->name }} ({{ $list->sum }}
                                                                <small>{{ $list->unit }}</small>) - Rp
                                                                {{ number_format($list->price) }}
                                                            </li>
                                                        @endforeach
                                                    </ol>
                                                </td>
                                                <td>
                                                    <span class="text-danger">
                                                        Rp {{ number_format($total_price) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @php
                                                        $check_payment = App\Models\OrderPayment::where('id_order', $item->id);
                                                    @endphp
                                                    @if ($check_payment->count() != 0)
                                                        <span class=" text-success">Lunas</span>
                                                    @else
                                                        <span class=" text-danger">Belum Lunas</span>
                                                    @endif
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
            <!-- [ Main Content ] end -->
        </div>
    </section>
@endsection
