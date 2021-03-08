<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Submission;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
//        dd(auth()->user());
        return view('admin.dashboard', [
            'total_user' => User::all()->count(),
            'total_pengajuan_masuk' => Submission::whereNotNull('created_at')->count(),
            'total_pengajuan_diproses' => Submission::whereNotNull('processed_at')->count(),
            'total_pengajuan_selesai' => Submission::whereNotNull('approved_at')->count()
        ]);
    }
}
