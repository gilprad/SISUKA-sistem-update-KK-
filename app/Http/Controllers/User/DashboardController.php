<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Submission;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('user.dashboard');
    }
}
