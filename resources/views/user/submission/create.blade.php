@extends('layouts.master')

@section('title', 'Buat Pengajuan')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Buat Pengajuan</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Form pengajuan</h4>
                        </div>
                        <div class="card-body">
                            @include('partials.alerts.alerts')
                            <form action="{{ route('user.submission.store') }}" class="form" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Alasan</label>
                                    <input type="text" name="reason" id="reason" class="form-control" value="{{ old('reason') }}" placeholder="Alasan mengajukan pembaruan KK" required>
                                </div>
                                <div class="form-group">
                                    <label for="foto_ktp">Foto KTP</label>
                                    <input type="file" name="foto_ktp" id="foto_ktp" accept="image/*" class="form-control" value="{{ old('foto_ktp') }}" required>
                                    <small class="form-text text-muted">*KTP yang diunggah yaitu KTP pembuat laporan</small>
                                </div>

                                <div class="form-group">
                                    <label for="foto_kk">Foto KK</label>
                                    <input type="file" name="foto_kk" id="foto_kk" accept="image/*" class="form-control" value="{{ old('foto_kk') }}" required>
                                    <small class="form-text text-muted">*KK yang diunggah yaitu KK pembuat laporan</small>
                                </div>

                                <div class="form-group">
                                    <label for="foto_surat_pengantar">Surat Pengantar</label>
                                    <input type="file" name="foto_surat_pengantar" id="foto_surat_pengantar" accept="image/*" class="form-control" value="{{ old('foto_surat_pengantar') }}" required>
                                    <small class="form-text text-muted">*Surat pengantar yang diunggah yaitu surat pengantar dari desa</small>
                                </div>

                                <button type="submit" class="btn btn-md btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
