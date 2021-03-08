@extends('layouts.master')

@section('title', 'Detail Pengajuan')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detail pengajuan</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('partials.alerts.alerts')
                    <div class="wizard-steps">
                        <div class="wizard-step wizard-step-active">
                            <div class="wizard-step-icon">
                                <i class="fas fa-info"></i>
                            </div>
                            <div class="wizard-step-label">
                                Pengajuan Dibuat <br>
                                <small class="text-white">{{$submission->created_at}}</small>
                            </div>
                        </div>
{{--                        @if--}}
                        <div class="wizard-step wizard-step-{{$submission->rejected_at === null && $submission->status === \App\Submission::STATUS_REJECTED ? 'danger' : 'active'}}">
                            <div class="wizard-step-icon">
                                <i class="fas fa-{{$submission->rejected_at === null && $submission->status === \App\Submission::STATUS_REJECTED ? 'times' : 'stopwatch'}}"></i>
                            </div>
                            <div class="wizard-step-label">
                                Pengajuan {{ $submission->rejected_at === null && $submission->status === \App\Submission::STATUS_REJECTED ? 'Ditolak' : 'Diproses'}} <br>
                                <small class="text-white"> {{ $submission->rejected_at === null && $submission->status === \App\Submission::STATUS_REJECTED ? $submission->rejected_at : $submission->processed_at }}</small>
                            </div>
                        </div>
                        <div class="wizard-step {{$submission->status === \App\Submission::STATUS_COMPLETED ? 'wizard-step-success' : ''}}">
                            <div class="wizard-step-icon">
                                <i class="fas fa-{{$submission->status === \App\Submission::STATUS_COMPLETED ? 'check' : 'stopwatch'}}"></i>
                            </div>
                            <div class="wizard-step-label">
                                Pengajuan Selesai <br>
                                @if($submission->status === \App\Submission::STATUS_COMPLETED)
                                    <small>{{$submission->approved_at}}</small>
                                @endif
                            </div>
                        </div>
{{--                            @endif--}}
                    </div>
                </div>
            </div>
        </div>
    </section>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>ID Pengajuan: {{$submission->id}}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.submission.update', $submission->id) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label for="user">ID User</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ $submission->user->id }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="name">Email User</label>
                                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $submission->user->email) }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="description">Alasan pengajuan</label>
                                    <textarea name="description" id="description" rows="10" class="form-control" style="height: 80px" readonly>{{ old('reason', $submission->reason) }}</textarea>
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

                                @if($submission->status == \App\Submission::STATUS_PENDING)
                                <div class="form-group">
                                    <label for="reject_reason">Alasan ditolak (pesan apabila ditolak)</label>
                                    <textarea name="reject_reason" id="reject_reason" style="height: 50px" class="form-control">{{ old('reject_reason', $submission->reject_reason) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="action">Aksi</label>
                                    <select name="action" id="action" class="form-control">
                                        <option value="">Pilih aksi</option>
                                        <option value="accept" {{$submission->processed_at ? 'selected' : ''}}>Proses</option>
                                        <option value="reject" {{$submission->rejected_at ? 'selected' : ''}}>Tolak</option>
                                    </select>
                                </div>

                                    <input type="submit" class="btn btn-md btn-primary" value="Simpan">
                                @endif

                                @if($submission->status == \App\Submission::STATUS_PROCESSING)
                                    <div class="form-group">
                                        <label for="foto_kk_baru">Foto KK Baru</label>
                                        <input type="file" name="foto_kk_baru" id="foto_kk_baru" accept="application/pdf" class="form-control" value="{{ old('foto_kk') }}" required>
                                        <small class="form-text text-muted">*KK baru. Dengan mengunggah file KK Baru, maka status pengajuan dirubah menjadi SELESAI.</small>
                                    </div>

                                    <input type="submit" class="btn btn-md btn-primary" value="Simpan">
                                @endif


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
