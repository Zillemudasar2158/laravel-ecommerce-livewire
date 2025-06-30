<x-social />
<nav x-data="{ open: false }" class="bg-[#1C2331] border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Left Side: Navigation Links -->
            <div class="flex items-center">
                <div class="hidden sm:flex space-x-6">
                    <!-- Main nav links (desktop only) -->
                    @if(Route::has('login'))
                        @auth
                            <x-nav-link class="text-white" :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                {{ __('About') }}
                            </x-nav-link>
                        @else
                            <x-nav-link class="text-white" :href="route('home')" :active="request()->routeIs('home')">
                                {{ __('About') }}
                            </x-nav-link>
                        @endauth
                    @endif

                    @can('view permissions')
                        <x-nav-link class="text-white" :href="route('permission.list')" :active="request()->routeIs('permission.list')">
                            {{ __('Permission') }}
                        </x-nav-link>
                    @endcan

                    @can('view roles')
                        <x-nav-link class="text-white" :href="route('role.list')" :active="request()->routeIs('role.list')">
                            {{ __('Roles') }}
                        </x-nav-link>
                    @endcan

                    @can('view users')
                        <x-nav-link class="text-white" :href="route('user.list')" :active="request()->routeIs('user.list')">
                            {{ __('User') }}
                        </x-nav-link>
                    @endcan

                    <x-nav-link class="text-white" :href="route('product.list')" :active="request()->routeIs('product.list')">
                        {{ __('Products') }}
                    </x-nav-link>

                    @auth
                        <x-nav-link class="text-white" :href="route('order.list')" :active="request()->routeIs('order.list')">
                            {{ __('Orders') }}
                        </x-nav-link>
                    @endauth

                    @can('view all orders')
                        <x-nav-link class="text-white" :href="route('allorder.list')" :active="request()->routeIs('allorder.list')">
                            {{ __('Manage orders') }}
                        </x-nav-link>
                    @endcan

                    @can('view category')
                        <x-nav-link class="text-white" :href="route('category.list')" :active="request()->routeIs('category.list')">
                            {{ __('Add Category') }}
                        </x-nav-link>
                    @endcan

                    <x-nav_men />
                </div>
            </div>

            <!-- Right Side: Cart and Profile -->
            <div class="hidden sm:flex items-center space-x-4">
                @if (Route::has('login'))
                    @auth
                        @php $cartCount = \App\Models\Cart::where('user_id', auth()->id())->count(); @endphp
                        <div>
                            <a href="{{ route('cart.list') }}" class="relative text-white hover:text-blue-500">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="hidden sm:inline">Cart</span>
                                @if($cartCount > 0)
                                    <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs w-5 h-5 flex items-center justify-center rounded-full">
                                        {{ $cartCount }}
                                    </span>
                                @endif
                            </a>
                        </div>

                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center text-white text-sm focus:outline-none">
                                    <span>{{ Auth::user()->name }}</span>
                                    <svg class="ml-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @else
                        <x-nav-link class="text-white" :href="route('login')">{{ __('Login') }}</x-nav-link>
                        @if (Route::has('register'))
                            <x-nav-link class="text-white" :href="route('register')">{{ __('Register') }}</x-nav-link>
                        @endif
                    @endauth
                @endif
            </div>

            <!-- Mobile Toggle -->
            <div class="sm:hidden">
                <button @click="open = ! open" class="text-gray-300 hover:text-white focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        <x-search_layout />
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link class="text-black" :href="route('home')" :active="request()->routeIs('home')">
                {{ __('About') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link class="text-black" :href="route('product.list')" :active="request()->routeIs('product.list')">
                {{ __('Products') }}
            </x-responsive-nav-link>
            @auth
                <x-responsive-nav-link :href="route('order.list')" :active="request()->routeIs('order.list')">
                    {{ __('Orders') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('cart.list')" :active="request()->routeIs('cart.list')">
                    {{ __('Cart') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                    {{ __('Login') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
                    {{ __('Register') }}
                </x-responsive-nav-link>
            @endauth
        </div>

        @auth
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @endauth
    </div>
</nav>
