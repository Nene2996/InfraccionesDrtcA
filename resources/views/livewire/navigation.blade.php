<header class="bg-trueGray-700 "> 
    <div class="sticky top-0">
        <div class="container flex h-16">
            @auth
            <div class="flex items-center">
                <a href="/dashboard">
                    <img src="{{ url('/img/iconoDrtc.svg') }}" alt="iconoDrtc" class=" h-10 w-auto object-cover">
                </a>
            </div>
            <div class="flex items-center flex-1 text-white font-semibold hidden md:flex">   
                <nav class="flex-1">
                    <ul class="flex justify-end">
                        <li>
                            <div class=" relative">
                                <x-jet-dropdown>
                                    <x-slot name="trigger">
                                        @if (request()->routeIs('actasDeControl.show') || request()->routeIs('actasDeFiscalizacion.show'))
                                            <a class="hover:bg-trueGray-400 hover:text-black px-4 py-2 rounded-md bg-trueGray-400 text-black">Papeletas</a>
                                        @else 
                                        <div class="mr-4">
                                            <a href="hover:bg-trueGray-400 hover:text-black py-2 rounded-md">Papeletas</a>
                                        </div>
                                        @endif
                                    </x-slot>
                                    <x-slot name="content">
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Seleccionar el tipo de acta') }}
                                        </div>
                                        <x-jet-dropdown-link href="{{ route('actasDeControl.show') }} ">
                                            {{ __('Actas de Control') }}
                                        </x-jet-dropdown-link>
                                        <x-jet-dropdown-link href="{{ route('actasDeFiscalizacion.show') }}">
                                            {{ __('Actas de Fiscalizacion') }}
                                        </x-jet-dropdown-link>
                                    </x-slot>
                                </x-jet-dropdown>
                            </div>
                        </li>
                        <li class="px-1">
                            <x-jet-nav-link href="{{ route('MostrarResoluciones') }}" :active="request()->routeIs('MostrarResoluciones')">
                                {{ __('Resoluciones') }}
                            </x-jet-nav-link>
                        </li>
                        <li>
                            <x-jet-nav-link href="{{ route('MostrarTablaInfracciones') }}" :active="request()->routeIs('MostrarTablaInfracciones')">
                                {{ __('Tabla de Infracciones') }}
                            </x-jet-nav-link>
                        </li>
                        <li class="px-1">
                            <x-jet-nav-link href="#" :active="request()->routeIs('Mostrar_')">
                                {{ __('Inspectores') }}
                            </x-jet-nav-link>
                        </li>
                        <li>
                            <x-jet-nav-link href="{{ route('GenerarReportes') }}" :active="request()->routeIs('GenerarReportes')">
                                {{ __('Reportes') }}
                            </x-jet-nav-link>
                        </li>
                        <li>
                            <span class="border-r border-white mx-1"></span>
                        </li>
                    </ul>
                </nav>
                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none transition">
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
                                    {{ __('Salir del sistema') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>  
            </div>
            @else
            <div class="flex items-center">
                <a href="/">
                    <img src="{{ url('/img/iconoDrtc.svg') }}" alt="iconoDrtc" class=" h-10 w-auto object-cover">
                </a>
            </div>
            <div class="flex items-center flex-1">
                <div class="flex justify-end flex-1">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <i class="fas fa-user-circle text-white text-3xl cursor-pointer"></i>
                        </x-slot>
    
                        <x-slot name="content">
                            <x-jet-dropdown-link href="{{ route('login') }}">
                                {{ __('Iniciar Sesion') }}
                            </x-jet-dropdown-link>
                            <!---
                            <x-jet-dropdown-link href="{{ route('register') }}">
                                {{ __('Registrarse') }}
                            </x-jet-dropdown-link>
                            --->
                            
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>
            @endauth
        </div>
    </div>
</header>