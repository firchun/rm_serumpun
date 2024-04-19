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
                                            <th>Foto</th>
                                            <th>No. Invoice</th>
                                            <th>Pesanan</th>
                                            <th>tagihan</th>
                                            <th>Pembayaran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $item)
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
                                                        $order_item = App\Models\OrderItem::where(
                                                            'id_order',
                                                            $item->id,
                                                        )->get();
                                                        $total_price = $order_item->sum(function ($orderItem) {
                                                            return $orderItem->sum * $orderItem->price;
                                                        });
                                                        // dd($order_item->sum('sum * price'));
                                                    @endphp
                                                    <ol>
                                                        @foreach ($order_item as $list)
                                                            <li>{{ $list->name }} ({{ $list->sum }}) - Rp
                                                                {{ number_format($list->price) }}</li>
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
                                                        $check_payment = App\Models\OrderPayment::where(
                                                            'id_order',
                                                            $item->id,
                                                        );
                                                        $checkPaidOff = App\Models\OrderPaidOff::where(
                                                            'id_order',
                                                            $item->id,
                                                        );
                                                    @endphp
                                                    @if ($check_payment->count() != 0 && $checkPaidOff->count() == 0)
                                                        <span class="badge badge-warning"> Belum Lunas</span>
                                                    @elseif($checkPaidOff->count() > 0 && $check_payment->count() != 0)
                                                        <span class="badge badge-success">Lunas</span><br>
                                                        <small>{{ $checkPaidOff->first()->created_at->format('d-F-Y') }}</small>
                                                    @else
                                                        <span class="badge badge-danger">Belum Dibayar</span>
                                                    @endif
                                                </td>
                                                <td width="200">
                                                    <a href="{{ route('orders.print', $item->id) }}"
                                                        class="btn btn-light-primary mx-2" target="__blank"><i
                                                            class="fa fa-print"></i>
                                                    </a>
                                                    <a href="{{ route('orders.detail', $item->id) }}"
                                                        class="btn btn-light-primary mx-2"><i class="fa fa-eye"></i>
                                                    </a>
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
