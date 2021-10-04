<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Category
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            @if(session('success'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>{{session('success')}}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            <div class="card-header">
                                All Category
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">SL No.</th>
                                            <th scope="col">Category Name</th>
                                            <th scope="col">User</th>
                                            <th scope="col">Created At</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @php($i=1) --}}
                                        @foreach ($categories as $category)
                                        <tr>
                                            <th scope="row">{{ $categories->firstItem() + $loop->index }}</th>
                                            <td>{{ $category->category_name}}</td>
                                            <td>{{ $category->user->name}}</td>
                                            <td>{{ $category->created_at->diffForHumans()}}</td>
                                            <td><a href="{{ url('category/edit/'.$category->id) }}"
                                                    class="btn btn-info">Edit</a>
                                                <a href="{{ url('category/soft-delete/'. $category->id)}}"
                                                    class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $categories->links() }}
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Add Category</div>
                            <div class="card-body">
                                <form action="{{ route('store.category') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="categoryName">Category Name</label>
                                        <input type="text" name="category_name" class="form-control" id="categoryName"
                                            placeholder="Enter category name">
                                        @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Category</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                Trashed Category list
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">SL No.</th>
                                            <th scope="col">Category Name</th>
                                            <th scope="col">User</th>
                                            <th scope="col">Created At</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($trashedCategories as $category)
                                        <tr>
                                            <th scope="row">{{ $categories->firstItem() + $loop->index }}</th>
                                            <td>{{ $category->category_name}}</td>
                                            <td>{{ $category->user->name}}</td>
                                            <td>{{ $category->created_at->diffForHumans()}}</td>
                                            <td><a href="{{ url('category/restore/'.$category->id) }}"
                                                    class="btn btn-info">Restore</a>
                                                <a href="{{ url('category/p-delete/'. $category->id)}}"
                                                    class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                        @empty
                                        <td>No data found</td>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $trashedCategories->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>