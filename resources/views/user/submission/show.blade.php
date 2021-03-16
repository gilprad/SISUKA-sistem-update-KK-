@extends('layouts.master')

@section('title', 'Detail Pengajuan')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail pengajuan</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="description">Alasan pengajuan</label>
                                    <textarea name="description" id="description" rows="10" class="form-control" style="height: 80px" readonly>{{  $submission->reason }}</textarea>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <h4>KTP, KK, Surat Pengantar Desa</h4>
                                    </div>
                                    <div class="card-body">
                                        @if($submission->attachment->foto_ktp)
                                            <div class="text-center">
                                                <img src="{{ Storage::url($submission->attachment->foto_ktp) }}" style="width: 300px; height: 300px">
                                                <small class="text-muted">Foto KTP</small>
                                            </div>
                                        @endif
                                        <hr>
                                        @if($submission->attachment->foto_kk)
                                            <div class="text-center">
                                                <img src="{{ Storage::url($submission->attachment->foto_kk) }}" style="width: 150px; height: 150px">
                                                <small class="text-muted">Foto KK</small>
                                            </div>
                                        @endif
                                        <hr>
                                        @if($submission->attachment->foto_surat_pengantar)
                                            <div class="text-center">
                                                <img src="{{ Storage::url($submission->attachment->foto_surat_pengantar) }}" style="width: 150px; height: 150px">
                                                <small class="text-muted">Foto Surat Pengantar Desa</small>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
