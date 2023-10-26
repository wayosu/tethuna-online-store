<!-- Start Header Slider-->
<header class="header-slider">
  <div class="container-fluid">
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