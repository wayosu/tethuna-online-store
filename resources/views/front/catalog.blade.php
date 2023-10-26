@extends('front.layouts.app')

@push('styles')
    <style>
        .catalog {
            padding-top: 0 !important;
        }

        .carousel-item img {
            width: 100%;
            height: 400px !important;
            object-fit: cover;
        }

        .header-slider .carousel .carousel-item .carousel-caption {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            text-align: left;
            color: white;
            padding: 20px;
        }

        .header-slider .carousel .carousel-item .carousel-caption h1 {
            font-size: 40px;
            font-weight: 700;
        }

        .header-slider .carousel .carousel-item .carousel-caption p {
            font-size: 14px;
            font-weight: 300;
            margin-bottom: 20px;
            text-wrap: wrap;
            width: 60%;
        }

        .btn-custom-transparent {
            background-color: transparent;
            color: var(--light-color);
            border: none;
            border-radius: 0;
            padding: 6px 20px;
            font-size: 14px;
            font-weight: 500;
            border: 2px solid var(--light-color);
            transition: all 0.3s;
        }

        .btn-custom-transparent:hover {
            background-color: var(--light-color);
            border: 2px solid var(--light-color);
            color: var(--dark-color);
        }

        @media (max-width: 991.98px) {
            .carousel-item img {
                height: 350px !important;
            }
        }

        @media (max-width: 767.98px) {
            .carousel-item img {
                width: 100%;
                height: 250px !important;
                object-fit: cover;
            }
        }

        .page-link {
            background-color: transparent !important;
            color: #000 !important;
            margin: 0 10px;
            width: 30px;
            height: 30px;
            padding: 5px 12px;
            font-size: 12px;
            border-radius: 50%;
        }

        .active>.page-link, .page-link.active {
            background-color: #000 !important;
            color: #fff !important;
            border-color: #fff !important;
        }
    </style>
@endpush

@section('content')
    <!-- Start Header Slider-->
    <header class="header-slider">
        <div class="container">
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($mainSliders as $key => $mainSlider)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                            <img src="{{ asset('uploads/main-slider/' . $mainSlider->image) }}" class="d-block w-100" alt="Slider Image">
                            <div class="carousel-caption">
                                <h1>{{ $mainSlider->title ?? '' }}</h1>
                                <p class="text-wrap slider-subtitle">{{ $mainSlider->sub_title ?? '' }}</p>
                                <a href="{{ $mainSlider->link ?? '' }}" class="btn btn-custom-transparent">Shop Now</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </header>
    <!-- End Header Slider -->

    <!-- Start Catalog -->
    <section class="catalog">
        <div class="container">

            <div class="row g-2 g-lg-4 my-4 align-items-center catalog-filter">
                <div class="col-12 col-lg-9">
                    <form action="/catalog" method="get">
                        @if (request('category_product'))
                            <input type="hidden" name="category_product" value="{{ request('category_product') }}">
                        @endif
                        <input type="text" name="search" class="form-control" placeholder="Search Product ..." value="{{ request('search') }}">
                    </form>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="dropdown catalog-dropdown">
                        <button class="btn btn-category w-100 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @php
                                use App\Models\Category;
                            @endphp
                            {{ request('category_product') ?? 'Category' }}
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('catalog') }}">All</a></li>
                            @foreach ($categories as $category)
                                @if (count($category->catalogs) > 0)
                                    <li><a class="dropdown-item" href="{{ route('catalog', ['category_product' => $category->slug]) }}">{{ $category->name }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row g-3 g-xl-4">
                @foreach ($products as $product)
                    <div class="col-6 col-md-4 col-xl-3">
                        <a href="{{ route('product.detail', $product->slug) }}" class="brand-card">
                            <div class="brand-img">
                                <img src="{{ asset('uploads/catalog/image/' . $product->image ?? '') }}" alt="image">
                                <div class="brand-overlay">
                                    <span class="brand-category">
                                        <i class="fa-solid fa-tag"></i>
                                        {{ $product->category->name ?? '' }}
                                    </span>
                                </div>
                            </div>
                            <div class="brand-title">
                                <h6>{{ $product->name }}</h6>
                                <p>{{ 'Rp ' . number_format($product->price, 0, ',', '.') }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            @if (count($products) > 0)
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </section>
    <!-- End Catalog -->
@endsection
