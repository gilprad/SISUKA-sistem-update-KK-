@extends('layouts.master')

@section('title', 'Detail User')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detail User</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Info: {{ $user->name }}</h4>
                        </div>
                        <div class="card-body">
                            @include('partials.alerts.error_alert')
                            <form action="" method="POST">
                                @method('PUT')

                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" autocomplete="name" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="user">Email</label>
                                    <input type="text" name="email" id="email" class="form-control" value="{{ old( 'email', $user->email) }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <input type="text" name="role" id="role" class="form-control" value="{{ old( 'role', $user->role) }}" readonly>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
