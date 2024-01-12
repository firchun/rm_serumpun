<div class="card">
    <div class="card-header px-4">
        PIUTANG
    </div>
    <div class="card-body p-2">
        @if ($piutang == 0 && Auth::user()->role == 'user')
            <span class="text-muted text-center">Belum ada piutang</span>
        @else
            <table class="table table-hover">
                @foreach ($order as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ route('orders.detail', $item->id) }}"
                                class="text-black">{{ $item->invoice }}</a><br>
                            <small>Total tagihan : <span class="text-danger">Rp
                                    {{ number_format(App\Models\Order::getPiutang($item->id)) }}</span></small>
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
                                    <span class="badge badge-success">Lunas</span><br>
                                    <small>{{ $checkPaidOff->first()->created_at->format('d-F-Y') }}</small>
                                @endif
                            @else
                                <span class="badge badge-danger">Belum Dibayar</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
            <div class="d-flex justify-content-center">
                {{ $order->links('vendor.pagination.bootstrap-4') }}
            </div>
        @endif
    </div>
</div>
