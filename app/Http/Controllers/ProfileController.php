<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('profile', [
            'user' => auth()->user()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Verifikasi
        $this->validate($request,[
            'password' => 'nullable|string|min:8|confirmed',
        ]);
        auth()->user()->update([
            'password' => Hash::make($request->get('password'))
        ]);
        return redirect()->back()->withSuccess('Berhasil ganti password!');
    }

}
