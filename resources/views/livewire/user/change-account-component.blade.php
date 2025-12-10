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
                        <li><a href="{{ route('account') }}" wire:navigate>Account</a></li>
                        <li><span>Edit Account</span></li>
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
                    <h5 class="section-title"><span>Edit account</span></h5>

                    <form wire:submit="save">
                        <div class="mb-3">
                            <label for="name" class="form-label required">Name</label>
                            <input wire:model="name" type="text"
                                   class="form-control @error('name') is-invalid @enderror" id="name"
                                   placeholder="Name"
                                   required>
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label required">Email</label>
                            <input wire:model="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror" id="email"
                                   placeholder="Email"
                                   required>
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input wire:model="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror" id="password"
                                   placeholder="Password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-warning">
                                Save
                                <div wire:loading wire:target="save">
                                    <div class="spinner-grow spinner-grow-sm" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </button>
                        </div>

                    </form>
                </div>
            </div>


        </div>
    </div>
</div>
