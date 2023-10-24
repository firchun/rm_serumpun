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
    <table class="table table-borderles">
        <tr>
            <td style="width: 150px;">
                <img src="{{ public_path() }}/img/logo.png" alt="" width="100" />

            </td>
            <td class="text-center">
                <strong>RUMAH MAKAN SERUMPUN INDAH</strong><br>
                Jalan Taman Makam Pahlawan.<br>
                Kel. Kelapa Lima, Kec. Merauke<br>
                Kab. Merauke-Papua Selatan 99616<br>
                081344686261<br>
            </td>
            <td style="width: 150px;">
            </td>

        </tr>
    </table>
    <div class="invoice-body">
        <!-- Row start -->

        <div class="table-responsive">
            <table class="table table-bordered" style="font-size: 12px;">
                <thead>
                    <tr class="bg-success text-white">
                        <th>#</th>
                        {{-- <th>Foto</th> --}}
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
                            {{-- <td width="150">
                                <div class="thumbnail">
                                    <div class="thumb">
                                        <a href="{{ $item->thumbnail == '' ? asset('img/no-image.jpg') : url(Storage::url($item->thumbnail)) }}"
                                            data-lightbox="1" data-title="{{ $item->invoice }}" data-toggle="lightbox">
                                            <img src="{{ $item->thumbnail == '' ? asset('img/no-image.jpg') : url(Storage::url($item->thumbnail)) }}"
                                                alt="{{ $item->invoice }}" class="img-fluid img-avatar" width="100">
                                        </a>
                                    </div>
                                </div>
                            </td> --}}
                            <td>
                                <strong>{{ $item->invoice }}</strong>
                                <br>
                                <small class="text-muted">{{ Str::limit($item->description, 100) }}</small>
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
                                        <li>{{ $list->name }} ({{ $list->sum }} <small>{{ $list->unit }}</small>)
                                            - Rp
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
