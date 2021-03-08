@extends('layouts.master')

@section('title', 'User')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Users</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">List semua user</h2>
            <p class="section-lead">Halaman untuk menampilkan semua user</p>
            <div class="card">
                <div class="card-header">
                    <h4>Daftar semua user</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
