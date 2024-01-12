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
                    <tr>
                        <th>#</th>
                        <th>Nama Pelanggan</th>
                        <th>Total Pemesanan</th>
                        <th>Total Piutang</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td width="10">{{ $loop->iteration }}</td>
                            <td>
                                {{ $item->name }}<br>
                                <a href="https://wa.me/{{ $item->phone }}" class="text-success">{{ $item->phone }}</a>
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
