<div>
    @section('meta-tags')
        <title>{{ config('app.name') . ' :: ' . ($title ?? 'Page Title') }}</title>
        <meta name="description" content="Default metadesc">
    @endsection
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="breadcrumbs">
                    <ul>
                        <li><a href="{{ route('home') }}" wire:navigate>Home</a></li>
                        <li><span>Account</span></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="container">

        <div class="row">

            <div class="col-lg-4 mb-3">
                <div class="cart-summary p-3 sidebar">
                    <h5 class="section-title"><span>Links</span></h5>
                    @include('includes.account-links')
                </div>
            </div>
            <div class="col-lg-8 mb-3">
                <div class="cart-content p-3 h-100 bg-white">
                    <p>Welcome, {{ auth()->user()->name }}!</p>
                    @include('includes.account-links')
                </div>
            </div>


        </div>
    </div>
</div>
