<nav
      class="navbar navbar-expand-lg fixed-top"
      id="navbar"
    >
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
          <img
            src="{{ asset('assets/front/img/logo.jpg') }}"
            alt="Logo"
          />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
            <i class="fa-solid fa-bars-staggered"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          @if (Route::is('home'))
          <ul class="navbar-nav m-auto gap-0 gap-lg-2">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about-us">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#gallery">Gallery</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#videos">Videos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#information">Information</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#contact-us">Contact Us</a>
            </li>
          </ul>

          <div>
            <a class="btn btn-nav-link" href="{{ route('catalog') }}">
              <i class="fa-solid fa-table-list"></i>&nbsp;
              Catalog
            </a>
            @auth
              <a class="btn btn-nav-link2" href="{{ route('admin.dashboard') }}">
                Back to Dashboard &nbsp;
                <i class="fa-solid fa-arrow-right"></i>
              </a>
            @endauth
          </div>
          @else
          <div class="ms-auto">
            <a class="btn btn-nav-link" href="{{ url('/') }}">
              <i class="fa-solid fa-home"></i>&nbsp;
              Home
            </a>
            @if (Route::is('product.detail'))
              <a class="btn btn-nav-link" href="{{ url('/catalog') }}">
                <i class="fa-solid fa-table-list"></i>&nbsp;
                Catalog
              </a>
            @endif
            @auth
              <a class="btn btn-nav-link2" href="{{ route('admin.dashboard') }}">
                Back to Dashboard &nbsp;
                <i class="fa-solid fa-arrow-right"></i>
              </a>
            @endauth
          </div>
          @endif
        </div>
      </div>
    </nav>