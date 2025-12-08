<div class="header-top-account d-flex justify-content-end">
    <div class="btn-group me-2">
        <div class="dropdown">
            <button class="btn btn-sm dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                Account
            </button>
            <ul class="dropdown-menu">
                @guest()
                    <li>
                        <a class="dropdown-item" href="{{ route('login') }}" wire:navigate>Sign In</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('register') }}" wire:navigate>Sign Up</a>
                    </li>
                @endguest

                @auth
                    <li>
                        <a class="dropdown-item" href="#">Your account</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}" wire:navigate>Logout</a>
                    </li>

                @endauth

                @if(auth()->user() && auth()->user()->is_admin)
                    <li>
                        <a class="dropdown-item" href="#">Dashboard</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>

