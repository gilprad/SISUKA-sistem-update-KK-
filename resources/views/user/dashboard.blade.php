@extends('layouts.master')

@section('title', 'User Dashboard')

@section('content')

    {{--        @if--}}

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
                            You don't have any submission.
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg" tabindex="4">
                                Create One
                            </button>
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
    {{--        @elseif --}}
    {{--<div class="main-content d-flex flex-column align-items-center justify-content-center">--}}
    {{--        <section class="section">--}}
    {{--            <div class="container mt-5">--}}
    {{--                <div class="page-error">--}}
    {{--                    <div class="page-inner">--}}
    {{--                        <div class="page-description">--}}
    {{--                            Your submission is still being processed.--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </section>--}}
    {{--</div>--}}
    {{--    @endif--}}

@endsection
