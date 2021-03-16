@extends('layouts.master')

@section('title', 'User Dashboard')

@section('content')
    <div class="d-flex flex-column align-items justify-content-start">
        <section class="section">
            <div class="section-header">
                <h1>User Dashboard</h1>
            </div>
            @if(auth()->user()->hasVerifiedEmail())
            <div class="container mt-5">
                <div class="page-error ">
                    <div class="page-inner">
                        <div class="page-description">
                            Selamat datang di SISUKA (Sistem Update KK)
                        </div>
                    </div>
                </div>
            </div>
            @else
                <div class="container mt-5">
                    <div class="page-error ">
                        <div class="page-inner">
                            <div class="page-description alert alert-error">
                                Email anda belum terverifikasi, silahkan periksa email anda.
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </section>
    </div>
@endsection
