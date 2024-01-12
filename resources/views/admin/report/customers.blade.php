@extends('layouts.backend.admin')

@section('content')
    <section class="pc-container">

        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            @include('layouts.backend.title')
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="p-3 bg-white rounded">
                        <span><i data-feather="filter"></i> Filter</span>
                        <hr>
                        <form action="{{ route('report.customers_filter') }}" enctype="multipart/form-data" method="GET">

                            <div class="form-inline">
                                <div class="mr-2">
                                    <select name="paid_off" class="form-control">
                                        <option value="-">--Pilih Pelunasan--</option>
                                        <option value="0" {{ old('paid_off') == '0' ? 'selected' : '' }}>Belum Lunas
                                        </option>
                                        <option value="1" {{ old('paid_off') == '1' ? 'selected' : '' }}>Sudah Lunas
                                        </option>
                                    </select>
                                </div>
                                <div class="mx-2">
                                    <select name="user" class="form-control">
                                        <option value="-">--Pilih Pelanggan--</option>
                                        @foreach ($user as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('user') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mx-2">
                                    <button type="submit" name="action" value="filter"
                                        class="btn btn-primary btn-md">Terapkan</button>
                                    <button type="submit" name="action" value="download" class="btn btn-danger"><i
                                            class="fa fas fa-file-pdf"></i>
                                        Download</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
                                            <th>Nama Pelanggan</th>
                                            <th>Total Pemesanan</th>
                                            <th>Total Piutang</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td width="10">{{ $loop->iteration }}</td>
                                                <td>
                                                    {{ $item->name }}<br>
                                                    <a href="https://wa.me/{{ $item->phone }}"
                                                        class="text-success">{{ $item->phone }}</a>
                                                </td>
                                                <td>
                                                    @if (App\Models\Order::getOrderUser($item->id) != 0)
                                                        {{ App\Models\Order::getOrderUser($item->id) }} Kali Pemesanan
                                                    @else
                                                        <span class="text-danger">Belum melakukan pemesanan</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <soan class="text-danger h3"> Rp
                                                        {{ number_format(App\Models\OrderItem::getPiutang($item->id)) }}
                                                    </soan>
                                                </td>
                                                <td>
                                                    <a href="{{ route('report.customers_detail', $item->id) }}"
                                                        class="btn btn-light-primary"><i class="fa fa-file-alt"></i>
                                                        Rincian</a>
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
