<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;

class LogAktivitasController extends Controller
{
    public function index()
    {
        $logs = LogAktivitas::with('pengguna')->latest()->paginate(20);
        return view('admin.log-aktivitas.index', compact('logs'));
    }
}
