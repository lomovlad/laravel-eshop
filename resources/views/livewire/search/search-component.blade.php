<div>
    <div class="container" id="products">
        <div class="row">
            <div class="col-12">
                <nav class="breadcrumbs">
                    <ul>
                        <li><a href="{{ route('home') }}" wire:navigate>Home</a></li>
                        <li><span>Search results</span></li>
                        <li><span>Search by: "{{ $query }}"</span></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="container position-relative">
        <div class="update-loading" wire:loading wire:target.except="add2Cart">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-12">

                @if(count($products))
                    <div class="row">

                        @foreach($products as $product)
                            <div class="col-lg-3 col-sm-6 mb-3" wire:key="{{ $product->id }}">
                                @include('includes.product-card')
                            </div>

                        @endforeach

                    </div>
                    <div class="row">
                        <div class="col-12">
                            {{ $products->links(data: ['scrollTo' => '#products']) }}
                        </div>
                    </div>
                @else
                    Товары не найдены :(
                @endif

            </div>
        </div>
    </div>
</div>

