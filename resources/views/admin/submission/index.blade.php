@extends('layouts.master')

@section('title', 'Pengajuan')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Pengajuan Masuk</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">List pengajuan masuk</h2>
            <p class="section-lead">Halaman untuk menampilkan semua pengajuan</p>
            <div class="card">
                <div class="card-header">
                    <h4>Daftar pengajuan</h4>
                </div>
                <div class="card-body">
                    @include('partials.alerts.alerts')
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
