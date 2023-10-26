<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover ms-n3" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav quick-links d-none d-lg-flex">
            <li class="nav-item">
                <a href="{{ url('/') }}"
                    class="nav-link">
                    <i class="ti ti-home me-1"></i> Home Page
                </a>
            </li>
        </ul>
        <div class="d-block d-lg-none">
            <img src="{{ asset('assets/front/img/favicon.png') }}" class="dark-logo" width="50" alt="" />
        </div>
        <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="p-2">
                <i class="ti ti-dots fs-7"></i>
            </span>
        </button>
        <div class="navbar-collapse justify-content-end px-0 collapse" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="javascript:void(0)" id="drop2"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="" width="35" height="35"
                            class="rounded-circle">
                        <div class="ms-2">
                            <span class="fw-bold fs-3 p-0">
                                {{ Auth::user()->name }}
                            </span>
                        </div>
                    </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                        <div class="message-body overflow-hidden">
                            <a href="{{ route('admin.account-setting') }}" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-user-cog fs-6"></i>
                                <p class="mb-0 fs-3">Account Setting</p>
                            </a>
                            <a class="btn btn-outline-primary mx-3 mt-2 d-block" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
