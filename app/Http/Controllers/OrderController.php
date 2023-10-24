<?php

namespace App\Http\Controllers;

use App\Models\FoodMenu;
use App\Models\Notifikasi;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderPaidOff;
use App\Models\OrderPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Daftar Pesanan',
            'orders' => Order::latest()->get(),
        ];
        return view('admin.order.index', $data);
    }
    public function member()
    {
        $data = [
            'title' => 'Daftar Pesanan',
            'orders' => Order::where('id_user', Auth::user()->id)->latest()->get(),
        ];
        return view('admin.order.member', $data);
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'thumbnail' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp', 'between:0,2048'],
                'id_user' => ['required'],
                'description' => ['nullable', 'string', 'max:191'],
                'name.*' => 'required|string',
                'sum.*' => 'required|numeric|min:1',
                'price.*' => 'required|numeric|min:0',
            ]);

            if ($request->hasFile('thumbnail')) {
                $filename = Str::random(32) . '.' . $request->file('thumbnail')->getClientOriginalExtension();
                $file_path = $request->file('thumbnail')->storeAs('public/uploads', $filename);
            }

            $orders = new Order();
            $orders->invoice = 'INV-' . substr(date('Y'), -2) . date('mdhis');
            $orders->id_user = $request->id_user;
            $orders->description = $request->description;
            // $orders->total_price = 0;
            $orders->thumbnail = isset($file_path) ? $file_path : '';
            $orders->save();


            // Simpan data pesanan ke model OrderItem
            $names = $request->name;
            $sums = $request->sum;
            $prices = $request->price;
            $units = $request->unit;

            foreach ($names as $key => $name) {
                $orderItem = new OrderItem();
                $orderItem->id_order = $orders->id; // Hubungkan dengan ID order yang baru saja dibuat
                $orderItem->name = $name;
                $orderItem->sum = $sums[$key];
                $orderItem->unit = $units[$key];
                $orderItem->price = $prices[$key];
                $orderItem->save();
            }

            // buat notifikasi
            $notifikasi = new Notifikasi();
            $notifikasi->id_user = $orders->id_user;
            $notifikasi->type = 'success';
            $notifikasi->content = 'Pesanan anda telah ditambahkan dengan nomor invoice : ' . $orders->invoice;
            $notifikasi->url = '/orders/member';
            $notifikasi->read_at = null;
            $notifikasi->save();

            return redirect()->back()->with('success', 'Berhasil menambahkan pesanan');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'terjadi kesalahan :' . $e->getMessage());
        }
    }
    public function storePayment(Request $request)
    {
        try {
            $request->validate([
                'thumbnail' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp', 'between:0,2048'],
                'id_order' => ['required'],
            ]);

            if ($request->hasFile('thumbnail')) {
                $filename = Str::random(32) . '.' . $request->file('thumbnail')->getClientOriginalExtension();
                $file_path = $request->file('thumbnail')->storeAs('public/uploads', $filename);
            }

            $order_payment = new OrderPayment();
            $order_payment->id_order = $request->id_order;
            $order_payment->thumbnail = isset($file_path) ? $file_path : '';
            $order_payment->save();

            // buat notifikasi
            $order = Order::find($request->id_order);
            $notifikasi = new Notifikasi();
            $notifikasi->id_user = $order->id_user;
            $notifikasi->type = 'success';
            $notifikasi->content = 'Admin telah menambahkan bukti pembayaran pada nomor invoice : ' . $order->invoice;
            $notifikasi->url = '/orders/member';
            $notifikasi->read_at = null;
            $notifikasi->save();

            return redirect()->back()->with('success', 'Berhasil menambahkan pembayaran');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'terjadi kesalahan :' . $e->getMessage());
        }
    }
    public function lunas(Request $request)
    {
        $paid_off = new OrderPaidOff();
        $paid_off->id_order = $request->id_order;
        $paid_off->id_user = Auth::user()->id;
        $paid_off->save();

        // buat notifikasi
        $order = Order::find($request->id_order);
        $notifikasi = new Notifikasi();
        $notifikasi->id_user = $order->id_user;
        $notifikasi->type = 'success';
        $notifikasi->content = 'Admin telah mengkonfirmasi pelunasan pada nomor invoice : ' . $order->invoice;
        $notifikasi->url = '/orders/member';
        $notifikasi->read_at = null;
        $notifikasi->save();

        return redirect()->back()->with('success', 'Berhasil konfirmasi pelunasan');
    }
    public function storeItems(Request $request)
    {
        try {
            $request->validate([
                'name.*' => 'required|string',
                'sum.*' => 'required|numeric|min:1',
                'price.*' => 'required|numeric|min:0',
            ]);
            // Simpan data pesanan ke model OrderItem
            $names = $request->name;
            $sums = $request->sum;
            $prices = $request->price;
            $units = $request->unit;

            foreach ($names as $key => $name) {
                $orderItem = new OrderItem();
                $orderItem->id_order = $request->id_order; // Hubungkan dengan ID order yang baru saja dibuat
                $orderItem->name = $name;
                $orderItem->unit = $units[$key];
                $orderItem->sum = $sums[$key];
                $orderItem->price = $prices[$key];
                $orderItem->save();
            }

            // buat notifikasi
            $order = Order::find($request->id_order);
            $notifikasi = new Notifikasi();
            $notifikasi->id_user = $order->id_user;
            $notifikasi->type = 'success';
            $notifikasi->content = 'Admin telah menambah pesanan pada nomor invoice : ' . $order->invoice;
            $notifikasi->url = '/orders/member';
            $notifikasi->read_at = null;
            $notifikasi->save();

            return redirect()->back()->with('success', 'Berhasil menambahkan pesanan');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'terjadi kesalahan :' . $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'thumbnail' => ['nullable', 'file', 'mimes:jpg,jpeg,png,bmp', 'between:0,2048'],
            'id_user' => ['required'],
            'description' => ['nullable', 'string', 'max:191'],

        ]);
        $orders = Order::findOrFail($id);
        if ($request->hasFile('thumbnail')) {
            if ($orders->thumbnail != '') {
                Storage::delete($orders->thumbnail);
            }

            $filename = Str::random(32) . '.' . $request->file('thumbnail')->getClientOriginalExtension();
            $file_path = $request->file('thumbnail')->storeAs('public/uploads', $filename);
        }

        $orders->id_user = $request->id_user;
        $orders->description = $request->description;
        $orders->thumbnail = isset($file_path) ? $file_path : $orders->thumbnail;
        $orders->save();

        return redirect()->back()->with('success', 'Berhasil mengubah pesanan');
    }
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $order_items = OrderItem::where('id_order', $order->id)->get();
        $data = [
            'title' => 'detail pesanan ' . $order->invoice,
            'order' => $order,
            'order_items' => $order_items,
        ];
        return view('admin.order.show', $data);
    }
    public function print($id)
    {
        $order = Order::find($id);
        $pdf = \PDF::loadview('admin/order/print', ['order' => $order])->setPaper("A4", "portrait");
        return $pdf->stream('invoice_' . $order->invoice . '.pdf');
    }
    public function destroy($id)
    {
        $orders = Order::findOrFail($id);
        if ($orders->thumbnail != '') {
            Storage::delete($orders->thumbnail);
        }
        $orders->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus pesanan');
    }
    public function destroyPayment($id)
    {
        $order_payment = OrderPayment::findOrFail($id);
        if ($order_payment->thumbnail != '') {
            Storage::delete($order_payment->thumbnail);
        }
        $order_payment->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus pesanan');
    }
    public function destroyItems($id)
    {
        $order_items = OrderItem::findOrFail($id);
        $order_items->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus pesanan');
    }
}
