
<header>
    <div class="flex bg-trueGray-700 w-full px-3 md:px-20 py-4">
        <div class="container flex items center mx-auto">
            <div>
                <a href="/">
                    <img src="{{ url('/img/iconoDrtc.svg') }}" alt="iconoDrtc" class="w-20">
                </a>
            </div>
            <div class="flex justify-end flex-1 md:hidden text-white text-3xl">
                <i class="fas fa-bars"></i>
            </div>
            <div class="flex items-end flex-1 text-white font-semibold hidden md:flex">
                <nav class="flex-1">
                    <ul class="flex justify-end flex-1">

                        @auth
                        <li class="px-4">
                            <a href="#">Papeletas</a>
                        </li>
                        <li class="px-4">
                            <a href="#">Nosotros</a>
                        </li>
                        <li class="px-4">
                            <a href="#">Ayuda</a>
                        </li>
                        <li class="px-4">
                            <span class="border-r border-white"></span>
                        </li>
                        <li>   
                            <x-jet-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                        </button>
                                    @else
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                                {{ Auth::user()->name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    @endif
                                </x-slot>

                                <x-slot name="content">
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Administrar cuenta') }}
                                    </div>

                                    <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Perfil') }}
                                    </x-jet-dropdown-link>

                                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                        <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                            {{ __('API Tokens') }}
                                        </x-jet-dropdown-link>
                                    @endif

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-jet-dropdown-link href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                            {{ __('Salir') }}
                                        </x-jet-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-jet-dropdown>
                        </li>
                        @else 
                        <li class="px-4">
                            <span class="border-r border-white"></span>
                        </li>
                        <li>
                            <x-jet-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <i class="fas fa-user-circle text-white text-3xl cursor-pointer"></i>
                                </x-slot>

                                <x-slot name="content">
                                    <x-jet-dropdown-link href="{{ route('login') }}">
                                        {{ __('Iniciar Sesion') }}
                                    </x-jet-dropdown-link>

                                    
                                </x-slot>
                            </x-jet-dropdown> 
                        </li>
                        @endauth
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>