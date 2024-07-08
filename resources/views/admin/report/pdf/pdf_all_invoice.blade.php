<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>{{ $title }}</title>
</head>

<body>
    <table class="table table-borderles" style="font-size:12px;">
        <tr>
            <td style="width: 150px;">
                <img src="{{ public_path() }}/img/logo.png" alt="" width="80" />

            </td>
            <td class="text-center">
                <strong>RUMAH MAKAN SERUMPUN INDAH</strong><br>
                Jalan Taman Makam Pahlawan.<br>
                Kel. Kelapa Lima, Kec. Merauke<br>
                Kab. Merauke-Papua Selatan 99616<br>
                0812-4188-6844<br>
            </td>
            <td style="width: 150px;">
            </td>

        </tr>
    </table>
    <div class="invoice-body">
        <div class="mb-3">
            <table class="table table-borderless" style="width: 50%; font-size:12px; ">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td>No HP</td>
                    <td>:</td>
                    <td>{{ $user->phone }}</td>
                </tr>
            </table>
        </div>
        <!-- Row start -->

        <div class="table-responsive">
            <table class="table table-bordered table-sm" style="font-size: 12px;">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Tanggal</td>
                        <td>No. Invoice</td>
                        <td>Pengambilan</td>
                        <td>Tagihan</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order as $item)
                        <tr>
                            <td width="10">{{ $loop->iteration }}</td>
                            <td> {{ \Carbon\Carbon::parse($item->date)->format('d F Y') }}</td>
                            <td>
                                <strong>{{ $item->invoice }}</strong>
                                <br>
                                <small class="text-muted">{{ Str::limit($item->description, 100) }}</small>
                            </td>

                            <td>
                                @php
                                    $checkReceived = App\Models\OrderReceived::where('id_order', $item->id);
                                @endphp
                                @if ($checkReceived->count() == 0)
                                    <span class="text-danger">Belum diambil</span>
                                @else
                                    <span class="text-success">Sudah diambil</span><br>
                                    {{ $checkReceived->first()->created_at->format('d F Y') }}
                                @endif
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

                        </tr>
                    @endforeach

                </tbody>
                @php
                    $total_all_prices = 0; // Inisialisasi total harga keseluruhan di luar loop
                @endphp

                @foreach ($order as $item)
                    @php
                        $order_item = App\Models\OrderItem::where('id_order', $item->id)->get();
                        $total_price = $order_item->sum(function ($orderItem) {
                            return $orderItem->sum * $orderItem->price;
                        });

                        // Tambahkan nilai total harga dari iterasi saat ini ke total harga keseluruhan
                        $total_all_prices += $total_price;
                    @endphp
                @endforeach
                <tfoot>
                    <th colspan="4" class="fw-bold text-center">TOTAL TAGIHAN</th>
                    <th>Rp {{ number_format($total_all_prices) }}</th>
                </tfoot>
            </table>
        </div>

        <!-- Row end -->
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>
