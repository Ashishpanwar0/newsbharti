
@extends('admin.sidebar')

@section('title', 'Edit Category')

@section('content')

<div class="mb-4">
    <h2 class="fw-bold">Edit Category</h2>
    <p class="text-secondary">Update category details below.</p>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('admin.categories.update', $category) }}"
              method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Category Name</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ old('name', $category->name) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description"
                          class="form-control"
                          rows="4">{{ old('description', $category->description) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                Update Category
            </button>

            <a href="{{ route('admin.categories.index') }}"
               class="btn btn-secondary">
                Cancel
            </a>
        </form>

    </div>
</div>

@endsection
