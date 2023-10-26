@extends('admin.layouts.app')

@section('content')
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <h4 class="fw-semibold mb-8">{{ $title ?? '' }}</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $title ?? '' }}</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- notifikasi --}}
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert"
            id="success-alert">
            <div class="d-flex gap-2 align-items-center">
                <div>
                    <span class="d-inline-flex p-1 rounded-circle border border-2 border-white mb-0">
                        <i class="fs-5 ti ti-check"></i>
                    </span>
                </div>
                <div>
                    {{ $message ?? '' }}
                </div>
            </div>
        </div>
    @elseif ($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert"
            id="danger-alert">
            <div class="d-flex gap-2 align-items-center">
                <div>
                    <span class="d-inline-flex p-1 rounded-circle border border-2 border-white mb-0">
                        <i class="fs-5 ti ti-alert-small"></i>
                    </span>
                </div>
                <div>
                    {{ $message ?? '' }}
                </div>
            </div>
        </div>
    @endif

    <div class="card">
        <form action="{{ route('admin.about-us.update', $data->id ?? '') }}" method="post">
            @csrf
            @method('put')
            <div class="card-body">
                <div class="position-relative">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">About Us</h5>
                        <p class="card-subtitle mb-0">Change information about us.</p>
                    </div>
                    <div class="mt-4">
                        <div class="mb-3">
                            <label class="control-label mb-1">Description of us</label>
                            <textarea name="desc" rows="6" class="form-control @error('desc') is-invalid @enderror">{{ $data->desc ?? '' }}</textarea>
                            @error('desc')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="control-label mb-1">Phone</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ $data->phone ?? '' }}" />
                            @error('phone')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="control-label mb-1">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $data->email ?? '' }}" />
                            @error('email')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="control-label mb-1">Google Maps</label>
                            <input type="text" name="maps" class="form-control @error('maps') is-invalid @enderror" value="{{ $data->maps ?? '' }}" />
                            @error('maps')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="control-label mb-1">Facebook</label>
                            <input type="text" name="facebook" class="form-control @error('facebook') is-invalid @enderror" value="{{ $data->facebook ?? '' }}" />
                            @error('facebook')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="control-label mb-1">Twitter</label>
                            <input type="text" name="twitter" class="form-control @error('twitter') is-invalid @enderror" value="{{ $data->twitter ?? '' }}" />
                            @error('twitter')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="control-label mb-1">Instagram</label>
                            <input type="text" name="instagram" class="form-control @error('instagram') is-invalid @enderror" value="{{ $data->instagram ?? '' }}" />
                            @error('instagram')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <div class="card-body border-top">
                    <button type="submit" class="btn btn-success rounded-pill px-4">
                        <div class="d-flex align-items-center">
                            <i class="ti ti-device-floppy me-1 fs-4"></i>
                            Update
                        </div>
                    </button>
                    <button type="reset" class="btn btn-danger rounded-pill px-4 ms-2 text-white">
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
