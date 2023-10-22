<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class notifikasiController extends Controller
{
    public function read($id)
    {
        try {
            $notif = Notifikasi::findOrFail($id);
            $notif->read_at = Carbon::now();
            $notif->save();
            return redirect($notif->url);
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function read_all($id)
{
    try {
        $notif = Notifikasi::where('id_user', $id)->where('read_at', null)->get();
        foreach ($notif as $notification) {
            $notification->read_at = Carbon::now();
            $notification->save();
        }
        return redirect()->back()->with('success', 'Notifikasi telah dibaca semua');
    } catch (\Exception $e) {
        return redirect()->back()->with('danger', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}
}
