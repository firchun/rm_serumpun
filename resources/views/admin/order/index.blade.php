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
                <div class="col-12 mb-4">
                    <div class="p-3 bg-white rounded">
                        <span><i data-feather="filter"></i> Filter</span>
                        <hr>
                        <form action="{{ route('orders.filter') }}" enctype="multipart/form-data" method="GET">
                            <div class="form-inline">
                                <div class="m-2">
                                    <select name="paid_off" class="form-control">
                                        <option value="-">--Pilih Pelunasan--</option>
                                        <option value="0" {{ old('paid_off') == '0' ? 'selected' : '' }}>Belum Lunas
                                        </option>
                                        <option value="1" {{ old('paid_off') == '1' ? 'selected' : '' }}>Sudah Lunas
                                        </option>
                                    </select>
                                </div>
                                <div class="m-2">
                                    <select name="received" class="form-control">
                                        <option value="-">--Pilih Pengambilan--</option>
                                        <option value="0" {{ old('received') == '0' ? 'selected' : '' }}>Belum Diambil
                                        </option>
                                        <option value="1" {{ old('received') == '1' ? 'selected' : '' }}>Sudah Diambil
                                        </option>
                                    </select>
                                </div>
                                <div class="m-2">
                                    <select name="user" class="form-control">
                                        <option value="-">--Pilih Pelanggan--</option>
                                        @foreach ($user as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('user') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="m-2 form-inline">
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
                            </div>
                            <div class="mt-4 text-center">
                                <button type="submit" class="btn btn-primary btn-md">Terapkan</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ $title }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center m-l-0">
                                <div class="col-sm-6">
                                </div>
                                <div class="col-sm-6 text-right">
                                    <button type="button" class="btn btn-success btn-md mb-3 btn-round" data-toggle="modal"
                                        data-target=".tambah"><i class="feather f-16 icon-plus"></i>
                                        Tambah</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mb-0 lara-dataTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Foto</th>
                                            <th>Tanggal</th>
                                            <th>User</th>
                                            <th>No. Invoice</th>
                                            {{-- <th>Pesanan</th> --}}
                                            <th>tagihan</th>
                                            <th>Pembayaran</th>
                                            <th>Pengambilan</th>
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
                                                    {{ \Carbon\Carbon::parse($item->date)->format('d F Y') }}

                                                </td>
                                                <td>
                                                    {{ $item->user->name }}
                                                </td>
                                                <td>
                                                    <strong>{{ $item->invoice }}</strong>
                                                    <br>
                                                    <small
                                                        class="text-muted">{{ Str::limit($item->description, 100) }}</small>
                                                </td>
                                                {{-- <td> --}}
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
                                                {{-- // <ol>
                                                    // @foreach ($order_item as $list)
                                                        // <li>{{ $list->name }} ({{ $list->sum }}) - Rp
                                                            // {{ number_format($list->price) }}</li>
                                                        //
                                                    @endforeach
                                                    // </ol>
                                                // </td> --}}
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

                                                    @if ($checkPaidOff->count() > 0)
                                                        <span class="badge badge-success">Lunas</span><br>
                                                        <small>{{ $checkPaidOff->first()->created_at->format('d-F-Y') }}</small>
                                                    @elseif ($check_payment->count() > 0)
                                                        <span class="badge badge-warning">Belum Lunas</span>
                                                    @else
                                                        <span class="badge badge-danger">Belum Dibayar</span>
                                                    @endif

                                                </td>
                                                <td>
                                                    @php
                                                        $checkReceived = App\Models\OrderReceived::where(
                                                            'id_order',
                                                            $item->id,
                                                        );
                                                    @endphp
                                                    @if ($checkReceived->count() == 0)
                                                        <button type="button"
                                                            class="btn btn-success btn-sm btn-round btn-block"
                                                            data-toggle="modal"
                                                            data-target=".received-{{ $item->id }}"><i
                                                                class="feather f-16 icon-check"></i>
                                                            Konfirmasi</button>
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
                                                <td width="200">
                                                    <a href="{{ route('orders.send_wa', [$item->id, $item->user->phone, $item->invoice, $total_price]) }}"
                                                        class="btn btn-light-{{ $item->send_wa == 1 ? 'secondary' : 'success' }} btn-sm"
                                                        target="__blank"><i class="fab fa-whatsapp f-16"></i>
                                                    </a>
                                                    <a href="{{ route('orders.print', $item->id) }}"
                                                        class="btn btn-light-primary mx-2 btn-sm" target="__blank"><i
                                                            class="fa fa-print"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-light-warning btn-sm"
                                                        data-toggle="modal" data-target=".edit-{{ $item->id }}"><i
                                                            class="icon feather icon-edit f-16"></i>
                                                    </button>
                                                    <a href="{{ route('orders.detail', $item->id) }}"
                                                        class="btn btn-light-primary mx-2 btn-sm"><i class="fa fa-eye"></i>
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
    {{-- modal create  --}}
    @include('admin.order.components.modal_create')
    {{-- modal edit --}}
    @foreach ($orders as $item)
        @include('admin.order.components.modal_edit')
        @include('admin.order.components.modal_received')
    @endforeach
@endsection
