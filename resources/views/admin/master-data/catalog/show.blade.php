@extends('admin.layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous"
        referrerpolicy="no-referrer" />

    <style>
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

        table tr td {
            padding: 5px;
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
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.' . $active) }}" class="text-muted">{{ $title ?? '' }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $subtitle ?? '' }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="shop-detail">
        <div class="card shadow-none border">
            <div class="card-body p-4">
                <a href="{{ route('admin.' . $active) }}" class="btn btn-sm btn-dark mb-3"><i class="ti ti-arrow-left"></i> Back to {{ $title ?? '' }}</a>

                <div class="row g-4">
                    <div class="col-lg-5">
                        <div id="sync1" class="owl-carousel owl-theme">
                            <div class="item rounded overflow-hidden">
                                <img src="{{ asset('uploads/catalog/image/' . $data->image) }}" alt=""
                                    class="img-fluid">
                            </div>
                            @if (count($data->catalogImages) > 0)
                                @foreach ($data->catalogImages as $item)
                                    <div class="item rounded overflow-hidden">
                                        <img src="{{ asset('uploads/catalog/other-image/' . $item->image) }}" alt=""
                                            class="img-fluid">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="shop-content">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="fs-2">Category</span>
                                <span
                                    class="badge text-bg-success fs-2 fw-semibold rounded-3">{{ $data->category->name ?? '' }}</span>
                            </div>
                            
                            <h4 class="fw-semibold">{{ $data->name ?? '' }}</h4>
                            <p class="mb-3">{{ $data->description ?? '' }}</p>
                            <h4 class="fw-semibold mb-3">{{ 'Rp ' . number_format($data->price, 0, ',', '.') }}</h4>

                            <div class="border-top border-bottom py-3">
                                <table>
                                    <tr>
                                        <td><strong>Fabric</strong></td>
                                        <td>:</td>
                                        <td>{{ $data->fabric ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Stock</strong></td>
                                        <td>:</td>
                                        <td>{{ $data->stock ?? '' }}</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="mt-3">
                                <a href="{{ route('admin.' . $active . '.edit', $data->id) }}"
                                    class="btn btn-warning">
                                    <i class="ti ti-pencil"></i> Edit Product
                                </a>
                                <form action="{{ route('admin.' . $active . '.delete', $data->id) }}"
                                    method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure?')">
                                        <i class="ti ti-trash"></i> Delete Product
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                    '<span class="position-absolute top-50 start-0 ms-2 translate-middle-y btn-nav-dark rounded-circle"><i class="ti ti-chevron-left"></i></span>',
                    '<span class="position-absolute top-50 end-0 me-2 translate-middle-y btn-nav-dark rounded-circle"><i class="ti ti-chevron-right"></i></span>'
                ],
            });
        })
    </script>
@endpush
