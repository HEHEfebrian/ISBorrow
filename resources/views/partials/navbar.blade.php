<nav class="navbar navbar-expand-lg fixed-top">

    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">

            <div class="logo-box me-2">

                <i class="bi bi-box-seam-fill"></i>

            </div>

            <span>
                ISBorrow
            </span>

        </a>

        <!-- Mobile Button -->
        <button class="navbar-toggler border-0 shadow-none"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarMenu">

            <i class="bi bi-list fs-2"></i>

        </button>

        <div class="navbar-collapse" id="navbarMenu">

            <!-- Menu -->

            <ul class="navbar-nav mx-auto">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                        href="{{ route('home') }}">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('catalog') ? 'active' : '' }}"
                        href="{{ route('catalog') }}">
                        Catalog
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                        href="{{ route('contact') }}">
                        Contact
                    </a>
                </li>

            </ul>

            <!-- Right Button -->

            <div class="d-flex">

                <a href="{{ route('login') }}" class="isb-btn">

                    <i class="bi bi-box-arrow-in-right me-2"></i>

                    Login

                </a>

            </div>

        </div>

    </div>

</nav>