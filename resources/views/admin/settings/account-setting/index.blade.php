@extends('admin.layouts.app')

@push('styles')
    <style>
        .shbtn-group {
            position: relative;
            overflow: hidden;
        }

        .shbtn {
            cursor: pointer;
            position: absolute;
            right: 0;
            top: 0;
            transform: translate(-50%, 50%);
            background: transparent;
            padding: 0 5px;
            z-index: 99;
            border: none;
        }

        .shbtn i {
            font-size: 18px;
            color: #333;
        }
    </style>
@endpush

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
        <form action="{{ route('admin.change-password', Auth::user()->id) }}" method="post">
            @csrf
            @method('put')
            <div class="card-body">
                <div class="position-relative">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Change Password</h5>
                        <p class="card-subtitle mb-0">Change your password.</p>
                    </div>
                    <div class="mt-4">
                        <div class="mb-3">
                            <label class="control-label mb-1">Current Password<span class="text-danger">*</span></label>
                            <div class="shbtn-group">
                                <input type="password" name="current_password"
                                    class="form-control @error('current_password') is-invalid @enderror" placeholder="..."
                                    value="{{ old('current_password') }}" />
                                <span class="shbtn toggle-password" data-target="current_password">
                                    <i class="ti ti-eye-off"></i>
                                </span>
                                @error('current_password')
                                    <small class="invalid-feedback">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="control-label mb-1">New Password<span class="text-danger">*</span></label>
                            <div class="shbtn-group">
                                <input type="password" name="new_password"
                                    class="form-control @error('new_password') is-invalid @enderror" placeholder="..."
                                    value="{{ old('new_password') }}" />
                                <span class="shbtn toggle-password" data-target="new_password">
                                    <i class="ti ti-eye-off"></i>
                                </span>
                                @error('new_password')
                                    <small class="invalid-feedback">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="control-label mb-1">Confirm New Password<span class="text-danger">*</span></label>
                            <div class="shbtn-group">
                                <input type="password" name="confirm_new_password"
                                    class="form-control @error('confirm_new_password') is-invalid @enderror"
                                    placeholder="..." value="{{ old('confirm_new_password') }}" />
                                <span class="shbtn toggle-password" data-target="confirm_new_password">
                                    <i class="ti ti-eye-off"></i>
                                </span>
                                @error('confirm_new_password')
                                    <small class="invalid-feedback">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
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

    <div class="card">
        <form action="{{ route('admin.change-information', Auth::user()->id) }}" method="post">
            @csrf
            @method('put')
            <div class="card-body">
                <div class="position-relative">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Change Account Information</h5>
                        <p class="card-subtitle mb-0">Change your name and email.</p>
                    </div>
                    <div class="mt-4">
                        <div class="mb-3">
                            <label class="control-label mb-1">Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="..." value="{{ old('name', Auth::user()->name) }}" />
                            @error('name')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="control-label mb-1">Email<span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            placeholder="..." value="{{ old('email', Auth::user()->email) }}" />
                        @error('email')
                            <small class="invalid-feedback">
                                {{ $message }}
                            </small>
                        @enderror
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

@push('scripts')
    <script>
        // show hide password jquery
        $(document).ready(function() {
            $(".toggle-password").on('click', function(event) {
                event.preventDefault();
                var target = $(this).data("target");
                var input = $("input[name=" + target + "]");
                var icon = $(this).find("i");

                if (input.attr("type") === "text") {
                    input.attr('type', 'password');
                    icon.removeClass("ti-eye").addClass("ti-eye-off");
                } else if (input.attr("type") === "password") {
                    input.attr('type', 'text');
                    icon.removeClass("ti-eye-off").addClass("ti-eye");
                }
            });
        });
    </script>
@endpush
