<?php

namespace App\Http\Controllers\Verifikator;

use App\Http\Controllers\Controller;
use App\Submission;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('verifikator.dashboard', [
            'total_pengajuan_masuk' => Submission::whereNotNull('created_at')->count(),
            'total_pengajuan_diproses' => Submission::whereNotNull('processed_at')->count(),
            'total_pengajuan_selesai' => Submission::whereNotNull('approved_at')->count()
        ]);
    }
}
