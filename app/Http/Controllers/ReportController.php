<?php

namespace App\Http\Controllers;

use App\Models\FoodMenu;
use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function menu()
    {
        $data = [
            'title' => 'Laporan data menu',
            'menu' => FoodMenu::all(),
        ];
        return view('admin.report.menu', $data);
    }
    public function pdf_menu()
    {
        $data = [
            'title' => 'Laporan data menu',
            'menu' => FoodMenu::all(),
        ];
        $pdf = \PDF::loadview('admin/report/pdf/pdf_menu', $data)->setPaper("A4", "portrait");
        return $pdf->stream('laporan_menu_' . date('d-m-Y') . '.pdf');
    }
    public function orders()
    {
        $data = [
            'title' => 'Laporan data pesanan',
            'order' => Order::all(),
        ];
        return view('admin.report.order', $data);
    }
    public function pdf_orders()
    {
        $data = [
            'title' => 'Laporan data pesanan',
            'order' => Order::all(),
        ];
        $pdf = \PDF::loadview('admin/report/pdf/pdf_order', $data)->setPaper("A4", "portrait");
        return $pdf->stream('laporan_pesanan_' . date('d-m-Y') . '.pdf');
    }
}
