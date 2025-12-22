<div class="row">
    <div class="col-12 mb-4 position-relative">
        <div class="update-loading" wire:loading wire:target="save, category_id">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('admin.products.index') }}" wire:navigate class="btn btn-primary">Products
                    List</a>
            </div>
            <div class="card-body">
                <form wire:submit="save">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input wire:model="title" type="text"
                               class="form-control @error('title') is-invalid @enderror" id="title"
                               placeholder="Product title"
                        >
                        @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label required">Category</label>
                        <select wire:model.live="category_id" id="category_id"
                                class="custom-select @error('category_id') is-invalid @enderror">
                            <option value="">Select category</option>
                            {!! \App\Helpers\Category\Category::getMenu('includes.menu-select-tpl') !!}
                        </select>
                        @error('category_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="row">
                        @foreach($this->filters as $k => $filter_group)
                            <div class="col-lg-3 col-md-6" wire:key="{{ $k }}">
                                <div class="card">
                                    <div class="card-header py-3">
                                        <h6 class="font-weight-bold text-primary m-0">{{ $filter_group[0]->title }}</h6>
                                    </div>
                                    <div class="card-body">
                                        @foreach($filter_group as $filter)
                                            <div class="" wire:key="{{ $filter->filter_id }}">
                                                <input
                                                    type="checkbox"
                                                    wire:model="selectedFilters"
                                                    value="{{ $filter->filter_id }}"
                                                    id="filter-{{ $filter->filter_id }}"
                                                >
                                                <label for="filter-{{ $filter->filter_id }}"
                                                       class="form-check-label">{{ $filter->filter_title }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input wire:model="price" type="number"
                               class="form-control @error('price') is-invalid @enderror" id="price"
                               placeholder="Product price"
                        >
                        @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="old_price" class="form-label">Old Price</label>
                        <input wire:model="old_price" type="number"
                               class="form-control @error('old_price') is-invalid @enderror" id="old_price"
                               placeholder="Product old price"
                        >
                        @error('old_price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="is_hit" class="form-check-label">Is hit</label>
                        <input wire:model="is_hit" type="checkbox"
                               class="@error('is_hit') is-invalid @enderror" id="is_hit">
                        @error('is_hit')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="is_new" class="form-check-label">Is new</label>
                        <input wire:model="is_new" type="checkbox"
                               class="@error('is_new') is-invalid @enderror" id="is_new">
                        @error('is_new')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Excerpt</label>
                        <input wire:model="excerpt" type="text"
                               class="form-control @error('excerpt') is-invalid @enderror" id="excerpt"
                               placeholder="Product excerpt">
                        @error('excerpt')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <div class="" wire:ignore>
                            <textarea class="form-control @error('content') is-invalid @enderror" id="summernote" rows="10"
                                      placeholder="Product content" wire:model="content"></textarea>
                        </div>
                        @error('content')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        @if($photo)
                            <img src="{{ asset($photo) }}" alt="" height="50">
                        @else
                            <img src="{{ asset($product->getImage()) }}" alt="" height="50">
                        @endif
                        <input wire:model="image" type="file"
                               class="form-control @error('image') is-invalid @enderror" id="image">
                        @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        <div wire:loading wire:target="image"><span class="text-success">Uploading...</span></div>

                        @if(!$errors->has('image') && $image && $image->isPreviewable())
                            <p class="text-danger">Click on the photo to delete it</p>
                            <img src="{{ $image->temporaryUrl() }}" alt="" height="100"
                                 wire:click="removeUpload('image', '{{ $image->getFileName() }}')">
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="gallery" class="form-label">Gallery</label>
                        @if($photos)
                            <div class="">
                                <p class="text-danger">Click on the photo to delete it</p>
                                @foreach($photos as $k => $item)
                                    <img
                                        src="{{ asset($item) }}"
                                        alt=""
                                        height="50"
                                        wire:key="{{ $k }}"
                                        wire:click="deleteGalleryItem({{$k}})"
                                        wire:confirm="Are you sure?">
                                @endforeach
                            </div>
                        @endif
                        <input wire:model="gallery"
                               type="file"
                               class="form-control @error('gallery.*') is-invalid @enderror"
                               id="gallery"
                               multiple
                               placeholder="Gallery multiple">
                        @error('gallery.*')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        <div wire:loading wire:target="gallery"><span class="text-success">Uploading...</span></div>

                        @if($gallery)
                            <p class="text-danger">Click on the photo to delete it</p>
                            <div class="mt-2">
                                @foreach($gallery as $photo)
                                    @if($photo->isPreviewable())
                                        <img src="{{ $photo->temporaryUrl() }}" alt="" height="100"
                                             wire:click="removeUpload('gallery', '{{ $photo->getFileName() }}')">
                                    @else
                                        <span class="text-danger">error!</span>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-info">
                            Save
                            <div wire:loading wire:target="save" class="spinner-grow spinner-grow-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@script
<script>
    $(function () {
        $('#summernote').summernote({
            callbacks: {
                onChange: function(contents, $editable) {
                    $wire.$set('content', contents, false);
                }
            },
            height: 300
        });
    })
</script>
@endscript
