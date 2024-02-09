<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Invoice #{{ $order->invoice }}</title>
</head>

<body>
    <table class="table table-borderles">
        <tr>
            <td>
                <img src="{{ public_path() }}/img/logo.png" alt="" width="100" />

            </td>
            <td>
                Jalan Taman Makam Pahlawan.<br>
                Kel. Kelapa Lima, Kec. Merauke<br>
                Kab. Merauke-Papua Selatan 99616<br>
                0812-4188-6844<br>
            </td>
            <td>
                <strong class="text-success">#{{ $order->invoice }}</strong><br>
                tanggal : {{ $order->created_at->format('d-m-Y') }}<br>
                <small>kepada Yth.</small><br>
                {{ $order->user->name }}<br>
                {{ $order->user->phone }}<br>

            </td>
        </tr>
    </table>
    <div class="invoice-body">
        <!-- Row start -->

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="bg-success text-white">
                        <th>No.</th>
                        <th>Pesanan</th>
                        <th>Jumlah</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $order_item = App\Models\OrderItem::where('id_order', $order->id)->get();
                        $total_price = $order_item->sum(function ($orderItem) {
                            return $orderItem->sum * $orderItem->price;
                        });
                        // dd($order_item->sum('sum * price'));
                    @endphp
                    @foreach ($order_item as $list)
                        <tr>
                            <td style="width:10px">
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $list->name }}
                            </td>
                            <td>{{ $list->sum }} <small>{{ $list->unit }} </small></td>
                            <td>Rp {{ number_format($list->price) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td>&nbsp;</td>
                        <td colspan="2">
                            <p>
                                Subtotal<br>
                            </p>
                            <h5 class="text-success"><strong>Grand Total</strong></h5>
                        </td>
                        <td>
                            <p>
                                Rp {{ number_format($total_price) }}
                            </p>
                            <h5 class="text-success"><strong> Rp {{ number_format($total_price) }}</strong></h5>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Row end -->
    </div>
    @if (Auth::user()->role == 'admin')
        <table class="table table-borderles">
            <tr>
                <td>Tanda Terima</td>
                <td></td>
                <td align="right" style="height: 100px">Hormat Kami</td>
            </tr>
        </table>
    @endif
    <small class="text-center">
        *Terimakasih atas kepercayaan anda berkunjung ke rumah makan kami<br>
        Dicetak pada {{ date('d-m-Y H:i:s') }}
    </small>



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
