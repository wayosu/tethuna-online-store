@extends('front.layouts.app')

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        .copy-link-button {
            display: inline-block;
            width: fit-content;
            padding: 6px 10px;
            font-size: 14px;
            background-color: var(--light-color);
            color: var(--dark-color);
            outline: none;
            border: none;
        }

        .toast-success {
            background-color: #000 !important; /* Set your custom background color here */
        }
    </style>
@endpush

@section('content')
    <!-- Start Slider  -->
    <section class="the-slider" data-aos="fade-up">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="owl-carousel owl-theme">
                        @foreach ($reviewSliders as $reviewSlider)
                            <div class="item">
                                <img src="{{ asset('uploads/review-slider/' . $reviewSlider->image) }}" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Slider  -->

    <!-- Start Slider  -->
    <section class="the-slider pt-0" data-aos="fade-up">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="owl-carousel owl-theme">
                        @foreach ($reviewSliders as $reviewSlider)
                            <div class="item">
                                <img src="{{ asset('uploads/review-slider/' . $reviewSlider->image) }}" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Slider  -->

    <!-- Start About us -->
    <section class="about-us" id="about-us">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-lg-6" data-aos="fade-right">
                    <div class="about-us-img">
                        <img src="{{ asset('assets/front/img/about-us.jpg') }}" alt="about-us-img">
                    </div>
                </div>
                <div class="col-12 col-lg-6" data-aos="fade-left">
                    <div class="card border-0 rounded-0">
                        <div class="card-body">
                            <h2 class="mb-3">About Us</h2>
                            <img src="{{ asset('assets/front/img/logo.jpg') }}" alt="logo">
                            <p class="my-3 text-justify" style="text-align: justify;">
                                {{ Str::limit($aboutUs->desc ?? '', 850) }}</p>
                            {{-- <a href="#">Read More <i class="fa-solid fa-arrow-right"></i></a> --}}
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- End About us -->

    <!-- Start Gallery -->
    <section class="gallery" id="gallery">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content-title" data-aos="fade-down">
                        <div class="text-center">
                            <h2 class="mb-3">Gallery</h2>
                            <p class="mb-5">Related about &nbsp;<img src="{{ asset('assets/front/img/logo.jpg') }}"
                                    alt="logo" width="120px"></p>
                        </div>
                    </div>
                    <div class="content-body" data-aos="fade-up">
                        <div class="categories-links">
                            <span class="category-link category-active" data-name="All">All</span>
                            @foreach ($categories as $category)
                                <span class="category-link" data-name="{{ $category->slug }}">{{ $category->name }}</span>
                            @endforeach
                            <a href="#">See More ...</a>
                        </div>

                        <div class="galleries">
                            @foreach ($galleries as $gallery)
                                <div class="gallery-img" data-name="{{ $gallery->category->slug ?? '' }}">
                                    <img src="{{ asset('uploads/catalog/image/' . $gallery->image ?? '') }}"
                                        alt="gallery-img">
                                    <div class="gallery-overlay">
                                        <h4 class="mb-0">{{ $gallery->name ?? '' }}</h4>
                                        <span>Category</span>
                                        <div class="gallery-button mt-2">
                                            <a href="{{ route('product.detail', $gallery->slug) }}"><i
                                                    class="fa-solid fa-magnifying-glass"></i></a>
                                            <button type="button" class="copy-link-button"
                                                data-link="{{ route('product.detail', $gallery->slug) }}"><i
                                                    class="fa-solid fa-link"></i></button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Gallery -->

    <!-- Start Videos -->
    <section class="videos" id="videos">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content-title" data-aos="fade-down">
                        <div class="text-center">
                            <h2 class="mb-3">Videos</h2>
                            <p class="mb-5">Latest video about &nbsp;<img src="{{ asset('assets/front/img/logo.jpg') }}"
                                    alt="logo" width="120px"></p>
                        </div>
                    </div>
                    <div class="content-body" data-aos="fade-up">
                        <div class="row g-3 g-lg-4">
                            @foreach ($videos as $video)
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="card border-0 rounded-0">
                                        <div class="card-body p-0">
                                            <iframe src="{{ $video->link_video ?? '' }}" frameborder="0"
                                                class="yt-frame"></iframe>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Videos -->

    <!-- Start Information -->
    <section class="information" id="information">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content-title" data-aos="fade-right">
                        <div class="text-left">
                            <h2 class="mb-3">Information</h2>
                            <p class="mb-5">Latest information about &nbsp;<img
                                    src="{{ asset('assets/front/img/logo.jpg') }}" alt="logo" width="120px"></p>
                        </div>
                    </div>
                    <div class="content-body" data-aos="fade-right">
                        <div class="owl-carousel owl-theme">
                            @foreach ($informations as $info)
                                <div class="item">
                                    <img src="{{ $info->link_image }}" alt="">
                                    <div class="info-overlay">
                                        <div class="info-title">
                                            <h4>
                                                {{ $info->title ?? '' }}
                                            </h4>
                                            <span class="mb-3">Sumber : {{ $info->source ?? '-' }}</span>
                                            <a href="{{ $info->link_information }}" target="_blank">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- End Information -->

    <!-- Start Contact Us -->
    <section class="contact-us" id="contact-us">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content-title" data-aos="fade-down">
                        <div class="text-center">
                            <h2 class="mb-3">Contact Us</h2>
                            <p class="mb-5"><img src="{{ asset('assets/front/img/logo.jpg') }}" alt="logo"
                                    width="120px"></p>
                        </div>
                    </div>
                    <div class="content-body" data-aos="fade-up">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-12 col-lg-6">
                                <iframe src="{{ $aboutUs->maps ?? '' }}" frameborder="0" class="maps-frame"></iframe>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="contact-us-card">
                                            <div class="contact-us-circle">
                                                <i class="fa-solid fa-phone"></i>
                                            </div>
                                            <div class="contact-us-text">
                                                <h5>Phone</h5>
                                                <span>{{ $aboutUs->phone ?? '' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="contact-us-card">
                                            <div class="contact-us-circle">
                                                <i class="fa-solid fa-envelope"></i>
                                            </div>
                                            <div class="contact-us-text">
                                                <h5>Email</h5>
                                                <span>{{ $aboutUs->email ?? '' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="contact-us-card">
                                            <div class="contact-us-circle">
                                                <i class="fa-solid fa-clock"></i>
                                            </div>
                                            <div class="contact-us-text">
                                                <h5>Opening Hours</h5>
                                                <span>Senin-Sabtu 13.00–19.00</span>
                                                <span>Minggu 13.00–18.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- End Contact Us -->
@endsection


@push('scripts')
    <!-- Include Clipboard.js and SweetAlert libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
       $(document).ready(function() {
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
        });
    </script>
@endpush
