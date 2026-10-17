
@extends('admin.sidebar')

@section('title', 'Categories Management')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold">Categories Management</h2>
        <p class="text-secondary mb-0">Manage categories and subcategories.</p>
    </div>

    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
        + Add Category / Subcategory
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

@forelse ($categories as $category)
    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h5 class="fw-bold mb-1">{{ $category->name }}</h5>
                    <small class="text-secondary">{{ $category->slug }}</small>

                    @if ($category->description)
                        <p class="mt-2 mb-0">{{ $category->description }}</p>
                    @endif
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('admin.categories.edit', $category) }}"
                       class="btn btn-sm btn-outline-primary">
                        Edit
                    </a>

                    <form action="{{ route('admin.categories.destroy', $category) }}"
                          method="POST"
                          onsubmit="return confirm('Delete this category?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            <hr>

            <h6 class="fw-bold">Subcategories</h6>

            @forelse ($category->subcategories as $subcategory)
                <div class="border rounded p-3 mb-2">

                    <div class="d-flex justify-content-between align-items-center">
                        <span>{{ $subcategory->name }}</span>

                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.categories.index', ['edit_subcategory' => $subcategory->id]) }}"
                               class="btn btn-sm btn-outline-primary">
                                Edit
                            </a>

                            <form action="{{ route('admin.subcategories.destroy', $subcategory) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this subcategory?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>

                    @if ($editSubcategory && $editSubcategory->id == $subcategory->id)
                        <form action="{{ route('admin.subcategories.update', $subcategory) }}"
                              method="POST" class="mt-3">
                            @csrf
                            @method('PUT')

                            <label class="form-label">Edit Subcategory Name</label>

                            <div class="input-group">
                                <input type="text"
                                       name="name"
                                       class="form-control"
                                       value="{{ old('name', $subcategory->name) }}"
                                       required>

                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>

                                <a href="{{ route('admin.categories.index') }}"
                                   class="btn btn-secondary">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    @endif

                </div>
            @empty
                <p class="text-secondary">No subcategories added yet.</p>
            @endforelse

            <form action="{{ route('admin.categories.subcategories.store', $category) }}"
                  method="POST" class="mt-3">
                @csrf

                <label class="form-label">
                    Add Subcategory to {{ $category->name }}
                </label>

                <div class="input-group">
                    <input type="text"
                           name="name"
                           class="form-control"
                           placeholder="Enter subcategory name"
                           required>

                    <button type="submit" class="btn btn-success">
                        Add Subcategory
                    </button>
                </div>
            </form>

        </div>
    </div>
@empty
    <div class="alert alert-info">
        No categories found. Click “Add Category / Subcategory” to create one.
    </div>
@endforelse

@endsection
