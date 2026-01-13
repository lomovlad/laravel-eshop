<div class="row">
    <div class="col-12 mb-4 position-relative">
        <div class="update-loading" wire:loading wire:target="save">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('admin.categories.create') }}" wire:navigate class="btn btn-primary">Add Category</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 10%;">ID</th>
                            <th style="width: 75%;">Title</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        {!! \App\Helpers\Category\Category::getMenu('includes.menu-table-tpl') !!}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
