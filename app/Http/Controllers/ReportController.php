<?php

namespace App\Http\Controllers;

use App\Models\FoodMenu;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function customers()
    {

        $data = [
            'title' => 'Piutang Pelanggan',
            'user' => User::where('role', 'user')->get(),
            'data' => User::where('role', 'user')->get(),
        ];
        return view('admin.report.customers', $data);
    }
    public function customers_filter(Request $request)
    {
        $paidOff = $request->paid_off;
        $idUser = $request->user;
        $action = $request->input('action');

        $userQuery = User::where('role', 'user');

        // Filter berdasarkan ID Pengguna
        if ($idUser != '-') {
            $userQuery->where('id', $idUser);
        }

        // Filter berdasarkan status pelunasan

        if ($paidOff != '-') {
            if ($paidOff == 0) {
                $userQuery->whereNotIn('id', function ($query) {
                    $query->select('id_user')
                        ->from('order_paid_offs');
                });
                $userQuery->whereIn('id', function ($query) {
                    $query->select('id_user')
                        ->from('orders');
                });
            } else {
                $userQuery->whereIn('id', function ($query) {
                    $query->select('id_user')
                        ->from('order_paid_offs');
                });
            }
        }
        if ($action == 'filter') {
            $data = [
                'title' => 'Piutang Pelanggan',
                'user' => User::where('role', 'user')->get(),
                'data' => $userQuery->get(),
            ];
            session()->flashInput($request->input());
            return view('admin.report.customers', $data);
        } else {

            $data = [
                'title' => 'Piutang Pelanggan',
                'user' => User::where('role', 'user')->get(),
                'data' => $userQuery->get(),
            ];

            $pdf = \PDF::loadview('admin/report/pdf/pdf_customers', $data)->setPaper("A4", "portrait");
            return $pdf->stream('piutang_pelanggan_' . date('d-m-Y') . '.pdf');
        }
    }


    public function customersDetail($id)
    {
        $user = User::find($id);
        $data = [
            'title' => 'Rincian piutang pelanggan : ' . $user->name,
            'user' => $user,
            'order' => Order::where('id_user', $user->id)->get(),
        ];
        return view('admin.report.customers_detail', $data);
    }
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
