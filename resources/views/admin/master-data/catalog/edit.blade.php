@extends('admin.layouts.app')

@push('styles')
    <style>
        .btn-modal-close {
            width: 30px;
            height: 30px;
            font-size: 12px;
            color: #fff;
            background-color: rgba(255, 255, 255, .3);
            border: none;
            border-radius: 50%;
            outline: none;
            cursor: pointer;
        }

        .forPraImg {
            overflow-x: auto !important; 
            overflow-y: hidden; 
            width: 100%;
        }

        .forPraImg::-webkit-scrollbar {
            height: 6px;
        }

        .forPraImg::-webkit-scrollbar-track {
            background: #f1f1f1; 
        }
        
        .forPraImg::-webkit-scrollbar-thumb {
            background: #888; 
        }

        .forPraImg::-webkit-scrollbar-thumb:hover {
            background: #555; 
        }

        .my-content-img {
            position: relative;
        }

        .my-content-img:before {
            content:"";
            position:absolute;
            width:100%;
            height:100%;
            top:0;left:0;right:0;
            background-color:rgba(0,0,0,0);
            transition: .3s ease-in-out;
        }

        .my-content-img:hover::before {
            background-color:rgba(0,0,0,0.5);
        }

        .my-content-img .my-btn-img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            opacity:0;
            transition: .3s ease-in-out;
        }

        .my-content-img:hover .my-btn-img {   
            opacity: 1;
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

    {{-- notifikasi --}}
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert" id="success-alert">
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
    @endif

    <div class="card">
        <form action="{{ route('admin.' . $active . '.update', $data->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card-body">
                <h5 class="mb-3">{{ $subtitle }} Form</h5>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="control-label mb-1">Product Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="..." value="{{ old('name', $data->name ?? '') }}" />
                            @error('name')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="control-label mb-1">Category <span class="text-danger">*</span></label>
                            <select name="category_id"
                                class="form-control form-select @error('category_id') is-invalid @enderror">
                                <option value="" selected hidden>-- Select Category --</option>
                                <option value="" hidden disabled selected>-- Pilih Jenis Peraturan --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if ($data->category_id == $category->id) selected @endif>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="control-label mb-1">Image <span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <input type="file" name="image"
                                    class="form-control @error('image') is-invalid @enderror" />
                                <input type="hidden" name="current_image" value="{{ $data->image ?? '' }}">
                                <button type="button" class="btn btn-info font-medium text-light" data-bs-toggle="modal"
                                    data-bs-target="#modal-image">
                                    <div class="d-flex align-items-center">
                                        <i class="ti ti-photo me-1 fs-4"></i>
                                        Current Image
                                    </div>
                                </button>
                                <div class="modal fade" id="modal-image" tabindex="1"
                                    aria-labelledby="vertical-center-modal" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="position-absolute top-0 end-0 me-2 mt-2">
                                                    <button type="button" class="btn-modal-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="ti ti-x"></i>
                                                    </button>
                                                </div>
                                                <img src="{{ asset('uploads/catalog/image/' . $data->image) }}"
                                                    alt="image" width="100%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @error('image')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="control-label mb-1">Other Images</label>
                            <input type="file" name="other_images[]"
                                class="form-control @error('other_images') is-invalid @enderror" multiple />
                            @error('other_images')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="control-label mb-1">Description</label>
                            <textarea name="description" class="form-control" rows="4">{{ old('description', $data->description) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="control-label mb-1">Price</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                <input type="text" id="priceInput" name="price" class="form-control"
                                    value="{{ old('price', $price) }}" placeholder="0" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="control-label mb-1">Stock</label>
                            <input type="number" name="stock" class="form-control"
                                value="{{ old('stock', $data->stock) }}" />
                        </div>
                        <div>
                            <label class="control-label mb-1">Fabric</label>
                            <input type="text" name="fabric" class="form-control"
                                value="{{ old('fabric', $data->fabric) }}" />
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
        <div class="card-body">
            <h5 class="mb-3">Other Images</h5>
            @if (count($data->catalogImages) > 0)
                <div class="forPraImg d-flex flex-row gap-2">
                    @foreach ($data->catalogImages as $image)
                        <div class="my-content-img">
                            <img src="{{ asset('uploads/catalog/other-image/' . $image->image) }}" alt="img" height="300px">
                            <form action="{{ route('admin.' . $active . '.delete-image', $image->id) }}" method="post" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger rounded-pill my-btn-img position-absolute">
                                    <i class="ti ti-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-warning mb-0" role="alert">
                    <div class="d-flex gap-2 align-items-center">
                        <span class="rounded-circle px-1 py-0 border border-2 border-warning text-light bg-warning mb-0 d-block" style="font-size: 16px;">
                            <i class="ti ti-alert-circle"></i>
                        </span>
                        <p class="mb-0">
                            No other images. <a href="{{ route('admin.' . $active . '.edit', $data->id) }}">Add</a> now.
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#priceInput').on('input', function() {
                // Get the input value and remove non-numeric characters
                let inputValue = $(this).val().replace(/\D/g, '');

                // Add commas to format the number
                inputValue = addCommas(inputValue);

                // Update the input field with the formatted value
                $(this).val(inputValue);
            });

            // Function to add commas to format the number
            function addCommas(nStr) {
                nStr += '';
                var x = nStr.split('.');
                var x1 = x[0];
                var x2 = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                }
                return x1 + x2;
            }
        });
    </script>
@endpush
