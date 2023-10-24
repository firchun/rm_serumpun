<?php

namespace App\Http\Controllers;

use App\Models\FoodMenu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function menu()
    {
        $data = [
            'title' => 'Laporan data menu',
            'menu' => FoodMenu::latest()->get(),
        ];
        return view('admin.report.menu', $data);
    }
    public function pdf_menu()
    {
        $data = [
            'title' => 'Laporan data menu',
            'menu' => FoodMenu::latest()->get(),
        ];
        $pdf = \PDF::loadview('admin/report/pdf/pdf_menu', $data)->setPaper("A4", "portrait");
        return $pdf->stream('laporan_menu_' . date('d-m-Y') . '.pdf');
    }
    public function orders()
    {
        $data = [
            'title' => 'Laporan data pesanan',
            'order' => Order::latest()->get(),
        ];
        return view('admin.report.order', $data);
    }
    public function pdf_orders(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $pembayaran = $request->pembayaran;

        $query = Order::where('created_at', '>=', $from_date)->where('created_at', '<=', $to_date);
        if ($pembayaran == 'lunas') {
            $query->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('order_paid_offs')
                    ->whereRaw('order_paid_offs.id_order = orders.id');
            });
        } elseif ($pembayaran == 'belum-lunas') {
            $query->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('order_paid_offs')
                    ->whereRaw('order_paid_offs.id_order = orders.id');
            });
        }

        $data = [
            'title' => 'Laporan data pesanan',
            'order' => $query->latest()->get(),
        ];
        $pdf = \PDF::loadview('admin/report/pdf/pdf_order', $data)->setPaper("A4", "portrait");
        return $pdf->stream('laporan_pesanan_' . date('d-m-Y') . '.pdf');
    }
}
