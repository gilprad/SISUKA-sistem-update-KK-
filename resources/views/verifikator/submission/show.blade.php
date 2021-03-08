@extends('layouts.master')

@section('title', 'Detail Submission')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detail Submission</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('partials.alerts')
                    <div class="wizard-steps">
                        <div class="wizard-step wizard-step-active">
                            <div class="wizard-step-icon">
                                <i class="fas fa-coffee"></i>
                            </div>
                            <div class="wizard-step-label">
                                Customer Memesan <br>
                                <small class="text-white">{{$order->created_at}}</small>
                            </div>
                        </div>
                        <div class="wizard-step wizard-step-{{$order->confirmed_at === null ? 'warning' : 'active'}}">
                            <div class="wizard-step-icon">
                                <i class="fas fa-{{$order->confirmed_at === null ? 'stopwatch' : 'money-bill-wave'}}"></i>
                            </div>
                            <div class="wizard-step-label">
                                Pembayaran Terkonfirmasi <br>
                                <small>{{$order->confirmed_at}}</small>
                            </div>
                        </div>
                        <div class="wizard-step {{$order->status === \App\Models\Order::STATUS_ON_DELIVERY || $order->shipping->status === \App\Models\Shipping::STATUS_SHIPPED ? 'wizard-step-active' : ''}}">
                            <div class="wizard-step-icon">
                                <i class="fas fa-shipping-fast"></i>
                            </div>
                            <div class="wizard-step-label">
                                Pesanan Terkirim <br>
                                @if ($order->status === \App\Models\Order::STATUS_ON_DELIVERY || $order->shipping->status === \App\Models\Shipping::STATUS_SHIPPED)
                                    <small>{{$order->shipping->updated_at}}</small>
                                @endif
                            </div>
                        </div>
                        <div class="wizard-step {{$order->status === \App\Models\Order::STATUS_COMPLETED ? 'wizard-step-success' : ''}}">
                            <div class="wizard-step-icon">
                                <i class="fas fa-{{$order->status === \App\Models\Order::STATUS_COMPLETED ? 'check' : 'stopwatch'}}"></i>
                            </div>
                            <div class="wizard-step-label">
                                Pesanan Selesai <br>
                                @if($order->status === \App\Models\Order::STATUS_COMPLETED)
                                    <small>{{$order->updated_at}}</small>
                                @endif
                            </div>
                        </div>
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
                        <h4>Submission id: {{$submission->id}}</h4>
                    </div>
                    <div class="card-body">
                        @include('partials.alerts.alerts')
                        <form action="{{ route('admin.proposals.update', $submission->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="user">User</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $submission->user->name }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="description">Reason</label>
                                <textarea name="description" id="description" rows="10" class="form-control" style="height: 80px" readonly>{{ old('reason', $submission->reason) }}</textarea>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h4>KTP, KK, Surat Pengantar Desa</h4>
                                </div>
                                <div class="card-body">
                                    @if($submission->foto_ktp)
                                        <div class="text-center">
                                            <img src="{{$submission->ktp_url}}" alt="{{$ktp->name}}'s logo" style="width: 300px; height: 300px">
                                            <small class="text-muted">Foto KTP</small>
                                        </div>
                                    @endif
                                    <hr>
                                    @if($submission->foto_kk)
                                        <div class="text-center">
                                            <img src="{{$submission->kk_url}}" style="width: 150px; height: 150px">
                                            <small class="text-muted">Foto KK</small>
                                        </div>
                                    @endif
                                    <hr>
                                    @if($submission->foto_surat_pengantar)
                                        <div class="text-center">
                                            <img src="{{$submission->surat_pengantar_url}}" style="width: 150px; height: 150px">
                                            <small class="text-muted">Foto Surat Pengantar Desa</small>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="reject_reason">Reject reason (pesan apabila ditolak)</label>
                                <textarea name="reject_reason" id="reject_reason" style="height: 50px" class="form-control">{{ old('reject_reason', $submission->reject_reason) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="action">Aksi</label>
                                <select name="action" id="action" class="form-control">
                                    <option value="-1">Pilih aksi</option>
                                    <option value="accept" {{$submission->processed_at ? 'selected' : ''}}>Proses</option>
                                    <option value="reject" {{$submission->rejected_at ? 'selected' : ''}}>Tolak</option>
                                </select>
                            </div>

                            <input type="submit" class="btn btn-md btn-primary" value="Simpan">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
@endsection
