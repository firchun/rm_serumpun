<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\FoodMenu;
use App\Models\Notifikasi;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PackagePrice;
use App\Models\Subdivision;
use App\Models\Transportation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // check not paid
        if (Auth::user()->role == 'user') {
            $order = Order::where('id_user', Auth::user()->id)->get();
            if ($order->count() != 0) {
                foreach ($order as $item) {
                    $order_item = OrderItem::where('id_order', $item->id)->get();
                    $total_price = $order_item->sum(function ($orderItem) {
                        return $orderItem->sum * $orderItem->price;
                    });
                }
                $piutang = $total_price;
            } else {
                $piutang = 0;
            }
        } else {
            $piutang = 0;
        }
        $order = Order::whereNotIn('id', function ($query) {
            $query->select('id_order')
                ->from('order_paid_offs');
        });
        //end check
        $data = [
            'title' => 'Dashboard',
            'users' => User::where('role', 'user')->count(),
            'menu' => FoodMenu::where('active', 1)->get(),
            'pesanan' => Order::count(),
            'piutang' => $piutang,
            'order' => Auth::user()->role == 'user' ? $order->where('id_user', Auth::user()->id)->paginate(10) : $order->paginate(10),
        ];
        return view('admin.dashboard', $data);
    }
    public function notifikasi()
    {
        $data = [
            'title' => 'Semua notifikasi',
            'notifikasi' => Notifikasi::where('id_user', Auth::user()->id)->orderBy('id', 'DESC')->get(),
        ];
        return view('admin.notifikasi', $data);
    }
}
