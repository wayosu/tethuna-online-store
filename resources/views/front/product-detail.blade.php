@extends('front.layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBjEFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
        .toast-success {
            background-color: #000 !important; /* Set your custom background color here */
        }

        .product-detail {
            margin: 40px 0;
        }

        .product-detail .card .card-body {
            padding: 60px !important;
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

        #sync1 .btn-nav-dark {
            width: 20px;
            height: 20px;
            padding: 2px;
            background-color: rgba(0, 0, 0, .6);
            color: #fff;
            font-size: 12px;
        }

        #sync1 .owl-nav {
            position: absolute;
            top: 50%;
            width: 100%;
            transform: translateY(-50%);
        }

        #sync1 .item {
            border-radius: 0 !important;
        }

        #sync1 .item img {
            height: fit-content;
            object-fit: cover;
        }

        table tr td {
            padding: 5px;
        }

        .category span {
            font-size: 14px !important;
        }

        .btn-copy {
            background-color: transparent;
            color: var(--dark-color);
            border: none;
            border-radius: 0;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 500;
            border: 2px solid var(--dark-color);
            transition: all 0.3s;
        }

        .btn-copy:hover {
            background-color: var(--dark-color);
            border: 2px solid var(--dark-color);
            color: var(--light-color);
        }

        .btn-shop {
            background-color: var(--dark-color);
            color: var(--light-color);
            border: none;
            border-radius: 0;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 500;
            border: 2px solid var(--dark-color);
            transition: all 0.3s;
        }

        .btn-shop:hover {
            background-color: var(--light-color);
            border: 2px solid var(--dark-color);
            color: var(--dark-color);
        }

        .related-product {
            margin-bottom: 50px;
        }

        .btn-see-more {
            text-decoration: none;
            color: var(--dark-color);
            font-size: 14px;
        }

        .btn-see-more:hover {
            text-decoration: underline;
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

    <section class="product-detail">
        <div class="container">
            <div class="card bg-transparent border-0 rounded-0">
                <div class="card-body p-0">
                    <div class="row g-4">
                        <div class="col-lg-5">
                            <div id="sync1" class="owl-carousel owl-theme">
                                <div class="item rounded overflow-hidden">
                                    <img src="{{ asset('uploads/catalog/image/' . $product->image) }}" alt=""
                                        class="img-fluid">
                                </div>
                                @if (count($product->catalogImages) > 0)
                                    @foreach ($product->catalogImages as $item)
                                        <div class="item rounded overflow-hidden">
                                            <img src="{{ asset('uploads/catalog/other-image/' . $item->image) }}" alt=""
                                                class="img-fluid">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="d-flex align-items-center gap-2 mb-2 category">
                                <span class="fs-2">Category</span>
                                <span class="badge text-bg-dark fs-2 fw-semibold rounded-0">
                                    <i class="fa-solid fa-tag"></i>
                                    {{ $product->category->name ?? '' }}
                                </span>
                            </div>

                            <h3 class="fw-semibold">{{ $product->name ?? '' }}</h3>
                            <p class="mb-3 small">{{ $product->description ?? '' }}</p>
                            <h4 class="fw-semibold mb-3">{{ 'Rp ' . number_format($product->price, 0, ',', '.') }}</h4>

                            <div class="border-top border-bottom py-3">
                                <table>
                                    <tr>
                                        <td><strong>Fabric</strong></td>
                                        <td>:</td>
                                        <td>{{ $product->fabric ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Stock</strong></td>
                                        <td>:</td>
                                        <td>{{ $product->stock ?? '' }}</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="mt-3">
                                <a href="javascript:void(0)" role="button"
                                    class="btn btn-copy copy-link-button"
                                    data-link="{{ route('product.detail', $product->slug) }}">
                                    <i class="fa fa-link"></i> Copy Link Product
                                </a>
                                <a href="https://wa.me/{{ $no_hp }}" class="btn btn-shop" target="_blank">
                                    <i class="fa fa-shop"></i> Shop Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="related-product" data-aos="fade-down">
        <div class="container">
            <div class="content-title mb-5">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="text-left">
                        <h2 class="mb-3">Related Products</h2>
                        <p class="mb-0">Related Products &nbsp;<img src="{{ asset('assets/front/img/logo.jpg') }}"
                                alt="logo" width="120px"></p>
                    </div>
                    <a href="{{ url('/catalog') }}" class="btn-see-more">See More...</a>
                </div>
            </div>
            <div class="row g-3 g-xl-4">
                @if (count($related_products) > 0)
                    @foreach ($related_products as $related_product)
                        <div class="col-6 col-md-4 col-xl-3">
                            <a href="{{ route('product.detail', $related_product->slug) }}" class="brand-card">
                                <div class="brand-img">
                                    <img src="{{ asset('uploads/catalog/image/' . $related_product->image ?? '') }}" alt="image">
                                    <div class="brand-overlay">
                                        <span class="brand-category">
                                            <i class="fa-solid fa-tag"></i>
                                            {{ $related_product->category->name ?? '' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="brand-title">
                                    <h6>{{ $related_product->name }}</h6>
                                    <p>{{ 'Rp ' . number_format($related_product->price, 0, ',', '.') }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="alert alert-dark text-center small border-0 rounded-0">
                            Related products were not found.
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    <script>
        // product detail
        $(function() {
            var sync1 = $("#sync1");

            sync1.owlCarousel({
                items: 1,
                slideSpeed: 2000,
                nav: true,
                autoplay: false,
                dots: false,
                loop: true,
                responsiveRefreshRate: 200,
                navText: [
                    '<span class="position-absolute top-50 start-0 ms-2 translate-middle-y btn-nav-dark rounded-circle"><i class="fa fa-chevron-left"></i></span>',
                    '<span class="position-absolute top-50 end-0 me-2 translate-middle-y btn-nav-dark rounded-circle"><i class="fa fa-chevron-right"></i></span>'
                ],
            });

            // Initialize Clipboard.js
            new ClipboardJS('.copy-link-button', {
                text: function(trigger) {
                    return $(trigger).attr('data-link');
                }
            });

            // Add a success event listener to show a Toastr toast notification
            $('.copy-link-button').on('click', function(e) {
                showCopySuccessNotification();
            });

            function showCopySuccessNotification() {
                // Show a Toastr toast notification
                toastr.success('Link Copied!', null, { 
                    timeOut: 1500,
                    positionClass: 'toast-bottom-left',
                    progressBar: true,
                });
            }
        })
    </script>
@endpush