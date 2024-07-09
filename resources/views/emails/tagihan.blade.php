<p>Hello {{ $order->user->name }},</p>
<h3>Total Piutang anda = Rp {{ App\Models\Order::getPiutang($order->id) }}</h3>
<p>Silahkan login pada website untuk cek tagihan anda {{ url('/login') }}</p>

<p>Terimakasih</p>
