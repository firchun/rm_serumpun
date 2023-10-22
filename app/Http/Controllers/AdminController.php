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
        $data = [
            'title' => 'Dashboard',
            'users' => User::where('role', 'member')->count(),
            'menu' => FoodMenu::where('active', 1)->get(),
            'pesanan' => OrderItem::count(),
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
