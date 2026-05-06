<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top py-3">
    <div class="container">
        <!-- Логотип -->
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
            <i class="bi bi-ticket-perforated-fill text-primary fs-3"></i>
            <span>Ticket<span class="text-primary">Sys</span></span>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <!-- Публічні посилання (зліва) -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-1">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('events.index') ? 'active fw-bold' : '' }}" href="{{ route('events.index') }}">
                        <i class="bi bi-calendar-event me-1"></i> Events
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('tickets.index') ? 'active fw-bold' : '' }}" href="{{ route('tickets.index') }}">
                        <i class="bi bi-ticket-detailed me-1"></i> Tickets
                    </a>
                </li>
            </ul>

            <!-- Користувацькі та Адмінські посилання (справа) -->
            <ul class="navbar-nav ms-auto align-items-lg-center gap-2">
                @auth
                    <!-- Швидкі посилання для Адміна -->
                    @if(auth()->user()->hasRole('admin'))
                        <li class="nav-item dropdown me-2">
                            <a class="nav-link dropdown-toggle text-warning fw-bold" href="#" data-bs-toggle="dropdown">
                                <i class="bi bi-shield-lock me-1"></i> Admin Panel
                            </a>
                            <ul class="dropdown-menu border-0 shadow-sm mt-2">
                                <li><a class="dropdown-item" href="{{ route('venues.index') }}"><i class="bi bi-buildings me-2"></i>Manage Venues</a></li>
                                <li><a class="dropdown-item" href="{{ route('events.index') }}"><i class="bi bi-calendar-event me-2"></i>Manage Events</a></li>
                                <li><a class="dropdown-item" href="{{ route('tickets.index') }}"><i class="bi bi-ticket-perforated me-2"></i>Manage Tickets</a></li>
                            </ul>
                        </li>
                        <li class="nav-item d-none d-lg-block mx-1">
                            <div class="vr text-white h-100 opacity-25"></div>
                        </li>
                    @endif

                    <!-- Чат / Підтримка -->
                    <li class="nav-item">
                        @if(auth()->user()->hasRole('admin'))
                            <a class="nav-link {{ request()->routeIs('admin.messages', 'chat') ? 'active text-primary fw-bold' : '' }}" href="{{ route('admin.messages') }}" title="User Messages">
                                <i class="bi bi-chat-dots fs-5"></i>
                                <span class="d-lg-none ms-2">Messages</span>
                            </a>
                        @else
                            <a class="nav-link {{ request()->routeIs('user.messages', 'chat') ? 'active text-primary fw-bold' : '' }}" href="{{ route('user.messages') }}" title="Contact Support">
                                <i class="bi bi-headset fs-5"></i>
                                <span class="d-lg-none ms-2">Support</span>
                            </a>
                        @endif
                    </li>

                    <!-- Корзина та Замовлення -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('cart.*') ? 'active text-primary fw-bold' : '' }}" href="{{ route('cart.index') }}">
                            <i class="bi bi-cart3 fs-5"></i>
                            <span class="d-lg-none ms-2">Cart</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('orders.*') ? 'active text-primary fw-bold' : '' }}" href="{{ route('orders.history') }}">
                            <i class="bi bi-clock-history fs-5"></i>
                            <span class="d-lg-none ms-2">Orders</span>
                        </a>
                    </li>

                    <!-- Профіль -->
                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" data-bs-toggle="dropdown">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 35px; height: 35px;">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="d-lg-none">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                            <li><h6 class="dropdown-header text-truncate">{{ Auth::user()->email }}</h6></li>
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person-gear me-2"></i> Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger fw-semibold">
                                        <i class="bi bi-box-arrow-right me-2"></i> Log Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Log in</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item ms-lg-2">
                            <a class="btn btn-primary px-4 rounded-pill" href="{{ route('register') }}">Register</a>
                        </li>
                    @endif
                @endauth
            </ul>
        </div>
    </div>
</nav>
