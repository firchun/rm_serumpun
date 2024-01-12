@extends('layouts.backend.admin')

@section('content')
    <section class="pc-container">

        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            @include('layouts.backend.title')
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            {{ $title }}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mb-0 lara-dataTable">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Aksi</td>
                                            <td>No. Invoice</td>
                                            <td>Tagihan</td>
                                            <td>Pembayaran</td>
                                            <td>Pengambilan</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order as $item)
                                            <tr>
                                                <td width="10">{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="{{ route('orders.print', $item->id) }}"
                                                        class="btn btn-light-primary mx-2 btn-sm" target="__blank"><i
                                                            class="fa fa-print"></i>
                                                    </a>
                                                    <a href="{{ route('orders.detail', $item->id) }}"
                                                        class="btn btn-light-primary mx-2 btn-sm"><i class="fa fa-eye"></i>
                                                    </a>
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
                                                    <span class="text-danger">
                                                        Rp {{ number_format($total_price) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @php
                                                        $check_payment = App\Models\OrderPayment::where('id_order', $item->id);
                                                        $checkPaidOff = App\Models\OrderPaidOff::where('id_order', $item->id);
                                                    @endphp
                                                    @if ($check_payment->count() != 0)
                                                        @if ($checkPaidOff->count() == 0)
                                                            <span class="badge badge-warning"> Belum Lunas</span>
                                                        @else
                                                            <span class="badge badge-success">Lunas</span>
                                                        @endif
                                                    @else
                                                        <span class="badge badge-danger">Belum Dibayar</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @php
                                                        $checkReceived = App\Models\OrderReceived::where('id_order', $item->id);
                                                    @endphp
                                                    @if ($checkReceived->count() == 0)
                                                        <span class="text-danger">Belum diambil</span>
                                                    @else
                                                        <small>
                                                            diambil oleh :
                                                            {{ $checkReceived->first()->recipent }}
                                                            <br>
                                                            Pada :
                                                            {{ $checkReceived->first()->created_at->format('d-F-Y') }}
                                                        </small>
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
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Detail Pelanggan
                        </div>
                        <div class="card-body">
                            <div class="my-3 text-center">
                                <img src="{{ $user->avatar == '' ? asset('img/user.png') : Storage::url($user->avatar) }}"
                                    class="img-fluid" style="height: 200px;">
                            </div>
                            <table class="table table-bordered">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td>No. HP</td>
                                    <td>:</td>
                                    <td>{{ $user->phone }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
