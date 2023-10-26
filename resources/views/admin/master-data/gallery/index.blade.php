@extends('admin.layouts.app')

@push('styles')
    <style>
        .card-gallery {
            position: relative;
        }

        .bg-image-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 1rem;
            display: flex;
            justify-content: start;
            align-items: start;
            flex-direction: column;
            background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, #000000 100%);
            color: #fff;
            opacity: 0; /* Initially, the overlay is transparent */
            transition: opacity 0.3s, transform 0.3s; /* Transition opacity and transform */
            transform: translateY(100%); /* Initially, the overlay is translated down */
            overflow: hidden;
        }

        .card-gallery:hover .bg-image-overlay {
            opacity: 1; /* When hovering, make the overlay visible */
            transform: translateY(0); /* Translate the overlay up to its original position */
            overflow-y: auto; /* Enable vertical scroll when content exceeds the height */
        }

        @media (max-width: 767.98px) {
            .bg-image-overlay .card-title {
                font-size: 16px !important;
            }

            .bg-image-overlay .card-text {
                font-size: 12px !important;
            }
        }

        .btn-filter {
            display: block !important;
            width: 100%;
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

    <div class="card">
        <div class="card-body">
            <form action="/admin/gallery" method="get">
                <div class="row g-2 g-md-3">
                    <div class="col-12 col-md-7 col-xl-8">
                        <select name="category" id="category" class="form-control">
                            <option value="">-- Filter by Category --</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->slug }}" {{ request()->get('category') == $category->slug ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-5 col-xl-4">
                        <button type="submit" class="btn btn-info btn-filter">
                            <i class="ti ti-filter-check"></i>
                            Apply Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
        
    @if (count($catalogs) > 0)
        <div class="row g-4">
            @foreach ($catalogs as $result)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card overflow-hidden card-gallery mb-0">
                    <img src="{{ asset('uploads/catalog/image/' . $result->image) }}" class="card-img-top" alt="image" />
                    <div class="bg-image-overlay">
                        <span class="badge text-bg-success fs-1 fw-semibold rounded-3">
                            {{ $result->category->name ?? '' }}
                        </span>
                        <h5 class="card-title fs-5 text-white text-wrap mt-2">
                            {{ $result->name ?? '' }}
                        </h5>
                        <p class="card-text">
                            {{ Str::limit($result->description, 50) }}
                        </p>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.catalog.show', $result->id) }}" class="small text-secondary"><i class="ti ti-eye"></i> Show</a>
                            <a href="{{ route('admin.catalog.edit', $result->id) }}" class="small text-warning"><i class="ti ti-edit"></i> Edit</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $catalogs->links() }}
        </div>
    @else
        <div class="card">
            <div class="card-body">
                <div class="alert alert-warning mb-0" role="alert">
                    <div class="d-flex gap-2 align-items-center">
                        <span class="rounded-circle px-1 py-0 border border-2 border-warning text-light bg-warning mb-0 d-block" style="font-size: 16px;">
                            <i class="ti ti-alert-circle"></i>
                        </span>
                        <p class="mb-0">
                            No product data yet. <a href="{{ route('admin.catalog') }}">Add</a> now.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
