<nav x-data="{ open: false }" class="navbar">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('user.home') }}" class="brand-link">
                        <span class="brand-text"><span class="highlight">GoAnywhere</span></span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:-my-px sm:ms-10 sm:flex items-center">
                    @auth
                        @if(Auth::user()->role == 'user')
                            <x-nav-link :href="route('user.home')" :active="request()->routeIs('user.home')" class="nav-link">
                                Home
                            </x-nav-link>
                            <x-nav-link :href="route('user.layanan')" :active="request()->routeIs('user.layanan')" class="nav-link">
                                Layanan
                            </x-nav-link>
                            <x-nav-link :href="route('user.armada')" :active="request()->routeIs('user.armada*')" class="nav-link">
                        Armada
                            </x-nav-link>
                            <x-nav-link :href="route('user.rental')" :active="request()->routeIs('user.rental')" class="nav-link">
                                Sewa Saya
                            </x-nav-link>
                            <x-nav-link :href="route('user.profile')" :active="request()->routeIs('user.profile')" class="nav-link">
                                Profile
                            </x-nav-link>
                        @elseif(Auth::user()->role == 'manager')
                            <x-nav-link :href="route('manager.dashboard')" :active="request()->routeIs('manager.dashboard')" class="nav-link">
                                Dashboard
                            </x-nav-link>
                            <x-nav-link :href="route('manager.vehicles')" :active="request()->routeIs('manager.vehicles*')" class="nav-link">
                                Kelola Armada
                            </x-nav-link>
                            <x-nav-link :href="route('manager.rentals')" :active="request()->routeIs('manager.rentals')" class="nav-link">
                        Transaksi
                            </x-nav-link>
                        @elseif(Auth::user()->role == 'superadmin')
                            <x-nav-link :href="route('superadmin.dashboard')" :active="request()->routeIs('superadmin.dashboard')" class="nav-link">
                                Dashboard
                            </x-nav-link>
                            <x-nav-link :href="route('superadmin.users')" :active="request()->routeIs('superadmin.users')" class="nav-link">
                                User
                            </x-nav-link>
                            <x-nav-link :href="route('superadmin.managers')" :active="request()->routeIs('superadmin.managers')" class="nav-link">
                                Manager
                            </x-nav-link>
                            <x-nav-link :href="route('superadmin.vehicles')" :active="request()->routeIs('superadmin.vehicles')" class="nav-link">
                        Armada
                            </x-nav-link>
                            <x-nav-link :href="route('superadmin.rentals')" :active="request()->routeIs('superadmin.rentals')" class="nav-link">
                        Transaksi
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Cart Icon (User only) -->
                @auth
                    @if(Auth::user()->role == 'user')
                        <a href="{{ route('user.cart') }}" class="cart-btn" title="Keranjang">
                            @php
                                $cartCount = \App\Models\Cart::where('user_id', auth()->id())
                                    ->where('status', 'pending')
                                    ->count();
                            @endphp
                            @if($cartCount > 0)
                                <span class="cart-badge">{{ $cartCount }}</span>
                            @endif
                        </a>
                    @endif
                @endauth

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="dropdown-trigger">
                            <span class="avatar">{{ substr(Auth::user()->name ?? 'U', 0, 1) }}</span>
                            <span class="trigger-name">{{ Auth::user()->name }}</span>
                            <svg class="dropdown-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @if(Auth::user()->role == 'user')
                            <x-dropdown-link :href="route('user.cart')" class="dropdown-link">
                                Cart
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('user.profile.user')" class="dropdown-link">
                                Profile User
                            </x-dropdown-link>
                            <div class="dropdown-divider"></div>
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" class="dropdown-link logout"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                        Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="hamburger-btn">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                @if(Auth::user()->role == 'user')
                    <x-responsive-nav-link :href="route('user.home')" :active="request()->routeIs('user.home')" class="responsive-link">
                        Home
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('user.layanan')" :active="request()->routeIs('user.layanan')" class="responsive-link">
                        Layanan
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('user.armada')" :active="request()->routeIs('user.armada*')" class="responsive-link">
                        Armada
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('user.rental')" :active="request()->routeIs('user.rental')" class="responsive-link">
                        Sewa Saya
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('user.profile')" :active="request()->routeIs('user.profile')" class="responsive-link">
                        Profile
                    </x-responsive-nav-link>
                @elseif(Auth::user()->role == 'manager')
                    <x-responsive-nav-link :href="route('manager.dashboard')" :active="request()->routeIs('manager.dashboard')" class="responsive-link">
                        Dashboard
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('manager.vehicles')" :active="request()->routeIs('manager.vehicles*')" class="responsive-link">
                        Kelola Armada
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('manager.rentals')" :active="request()->routeIs('manager.rentals')" class="responsive-link">
                        Transaksi
                    </x-responsive-nav-link>
                @elseif(Auth::user()->role == 'superadmin')
                    <x-responsive-nav-link :href="route('superadmin.dashboard')" :active="request()->routeIs('superadmin.dashboard')" class="responsive-link">
                        Dashboard
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('superadmin.users')" :active="request()->routeIs('superadmin.users')" class="responsive-link">
                        User
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('superadmin.managers')" :active="request()->routeIs('superadmin.managers')" class="responsive-link">
                        Manager
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('superadmin.vehicles')" :active="request()->routeIs('superadmin.vehicles')" class="responsive-link">
                        Armada
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('superadmin.rentals')" :active="request()->routeIs('superadmin.rentals')" class="responsive-link">
                        Transaksi
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="responsive-user-name">{{ Auth::user()->name }}</div>
                <div class="responsive-user-email">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                @if(Auth::user()->role == 'user')
                    <x-responsive-nav-link :href="route('user.cart')" class="responsive-link">
                        Cart
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('user.profile.user')" class="responsive-link">
                        Profile User
                    </x-responsive-nav-link>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" class="responsive-link logout"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        Log Out
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<style>
    /* ============================================ */
    /* NAVBAR STYLE - ELEGAN #43637E               */
    /* ============================================ */

    .navbar {
        background: #ffffff;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06), 0 1px 3px rgba(0, 0, 0, 0.04);
        border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        position: sticky;
        top: 0;
        z-index: 50;
    }

    /* ===== BRAND ===== */
    .brand-link {
        text-decoration: none;
    }

    .brand-text {
        font-size: 24px;
        font-weight: 700;
        color: #2c3e50;
        font-family: 'Georgia', serif;
        letter-spacing: -0.5px;
    }

    .brand-text .highlight {
        color: #43637E;
        position: relative;
    }

    .brand-text .highlight::after {
        content: '';
        position: absolute;
        bottom: -3px;
        left: 0;
        right: 0;
        height: 2.5px;
        background: linear-gradient(90deg, #43637E, #f0e6d0);
        border-radius: 4px;
    }

    /* ===== NAV LINK ===== */
    .nav-link {
        color: #374151;
        font-weight: 600;
        font-size: 14px;
        padding: 6px 14px;
        border-radius: 9999px;
        border-bottom: 3px solid transparent;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        letter-spacing: 0.3px;
    }

    .nav-link:hover {
        color: #43637E;
        background: #f3f4f6;
        border-bottom-color: transparent;
    }

    .nav-link[aria-current="page"] {
        color: #ffffff;
        background: #111827;
        border-bottom-color: transparent;
        font-weight: 700;
    }

    /* ===== CART BUTTON ===== */
    .cart-btn {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 10px;
        font-size: 20px;
        color: #5a6a7a;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-right: 6px;
    }

    .cart-btn:hover {
        background: rgba(67, 99, 126, 0.08);
        color: #43637E;
    }

    .cart-btn .cart-badge {
        position: absolute;
        top: -2px;
        right: -2px;
        background: #b04a4a;
        color: #ffffff;
        font-size: 10px;
        font-weight: 700;
        min-width: 18px;
        height: 18px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 8px rgba(176, 74, 74, 0.3);
    }

    /* ===== DROPDOWN TRIGGER ===== */
    .dropdown-trigger {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 14px 6px 6px;
        border: none;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        color: #2c3e50;
        background: #faf8f5;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
        font-family: inherit;
    }

    .dropdown-trigger:hover {
        background: #f0ede8;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
    }

    .dropdown-trigger .avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #43637E;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 700;
        text-transform: uppercase;
        flex-shrink: 0;
    }

    .dropdown-trigger .trigger-name {
        max-width: 120px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .dropdown-trigger .dropdown-icon {
        width: 16px;
        height: 16px;
        fill: #7a8a9a;
        flex-shrink: 0;
        transition: transform 0.3s ease;
    }

    /* ===== DROPDOWN LINK ===== */
    .dropdown-link {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 20px;
        font-size: 14px;
        font-weight: 500;
        color: #5a6a7a;
        text-decoration: none;
        transition: all 0.3s ease;
        border-radius: 8px;
        margin: 2px 6px;
    }

    .dropdown-link:hover {
        background: rgba(67, 99, 126, 0.06);
        color: #43637E;
    }

    .dropdown-link.logout {
        color: #b04a4a;
    }

    .dropdown-link.logout:hover {
        background: rgba(176, 74, 74, 0.08);
        color: #b04a4a;
    }

    .dropdown-divider {
        height: 1px;
        background: #f0ede8;
        margin: 4px 12px;
    }

    /* ===== HAMBURGER ===== */
    .hamburger-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px;
        border-radius: 10px;
        color: #5a6a7a;
        background: transparent;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .hamburger-btn:hover {
        background: rgba(67, 99, 126, 0.08);
        color: #43637E;
    }

    /* ===== RESPONSIVE LINK ===== */
    .responsive-link {
        display: block;
        padding: 10px 20px;
        font-size: 14px;
        font-weight: 500;
        color: #5a6a7a;
        text-decoration: none;
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
    }

    .responsive-link:hover {
        background: rgba(67, 99, 126, 0.06);
        color: #43637E;
        border-left-color: #43637E;
    }

    .responsive-link[aria-current="page"] {
        color: #43637E;
        border-left-color: #43637E;
        background: rgba(67, 99, 126, 0.04);
    }

    .responsive-link.logout {
        color: #b04a4a;
    }

    .responsive-link.logout:hover {
        background: rgba(176, 74, 74, 0.08);
        color: #b04a4a;
    }

    .responsive-user-name {
        font-weight: 700;
        font-size: 16px;
        color: #2c3e50;
        font-family: 'Georgia', serif;
    }

    .responsive-user-email {
        font-size: 14px;
        color: #7a8a9a;
        margin-top: 2px;
    }

    /* ============================================ */
    /* DARK MODE                                    */
    /* ============================================ */

    .dark .navbar {
        background: #1a2632;
        border-bottom-color: rgba(255, 255, 255, 0.04);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }

    .dark .brand-text {
        color: #f0ede8;
    }

    .dark .brand-text .highlight {
        color: #f0e6d0;
    }

    .dark .brand-text .highlight::after {
        background: linear-gradient(90deg, #f0e6d0, #43637E);
    }

    .dark .nav-link {
        color: #e5e7eb;
    }

    .dark .nav-link:hover {
        color: #f0e6d0;
        background: rgba(255, 255, 255, 0.1);
        border-bottom-color: transparent;
    }

    .dark .nav-link[aria-current="page"] {
        color: #ffffff;
        background: #ffffff;
        border-bottom-color: transparent;
        font-weight: 700;
    }

    .dark .cart-btn {
        color: #b0bec5;
    }

    .dark .cart-btn:hover {
        background: rgba(67, 99, 126, 0.15);
        color: #f0e6d0;
    }

    .dark .dropdown-trigger {
        color: #f0ede8;
        background: #0f1a24;
    }

    .dark .dropdown-trigger:hover {
        background: #1a2632;
    }

    .dark .dropdown-trigger .avatar {
        background: #43637E;
    }

    .dark .dropdown-trigger .dropdown-icon {
        fill: #7a8a9a;
    }

    .dark .dropdown-link {
        color: #b0bec5;
    }

    .dark .dropdown-link:hover {
        background: rgba(67, 99, 126, 0.15);
        color: #f0e6d0;
    }

    .dark .dropdown-link.logout {
        color: #d46a6a;
    }

    .dark .dropdown-link.logout:hover {
        background: rgba(212, 106, 106, 0.15);
        color: #d46a6a;
    }

    .dark .dropdown-divider {
        background: #2c3e50;
    }

    .dark .hamburger-btn {
        color: #b0bec5;
    }

    .dark .hamburger-btn:hover {
        background: rgba(67, 99, 126, 0.15);
        color: #f0e6d0;
    }

    .dark .responsive-link {
        color: #b0bec5;
    }

    .dark .responsive-link:hover {
        background: rgba(67, 99, 126, 0.15);
        color: #f0e6d0;
        border-left-color: #f0e6d0;
    }

    .dark .responsive-link[aria-current="page"] {
        color: #f0e6d0;
        border-left-color: #f0e6d0;
        background: rgba(67, 99, 126, 0.08);
    }

    .dark .responsive-link.logout {
        color: #d46a6a;
    }

    .dark .responsive-link.logout:hover {
        background: rgba(212, 106, 106, 0.15);
        color: #d46a6a;
    }

    .dark .responsive-user-name {
        color: #f0ede8;
    }

    .dark .responsive-user-email {
        color: #7a8a9a;
    }

    /* ============================================ */
    /* RESPONSIVE                                   */
    /* ============================================ */

    @media (max-width: 640px) {
        .brand-text {
            font-size: 20px;
        }

        .dropdown-trigger .trigger-name {
            display: none;
        }

        .dropdown-trigger {
            padding: 6px 8px;
        }

        .cart-btn {
            width: 36px;
            height: 36px;
            font-size: 18px;
        }
    }
</style>