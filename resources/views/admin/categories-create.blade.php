
@extends('admin.sidebar')

@section('title', 'Create Category and Subcategory')

@section('content')

<div class="mb-4">
    <h2 class="fw-bold">Create Category & Subcategory</h2>
    <p class="text-secondary">Create a category or add a subcategory to an existing category.</p>
</div>

<div class="mb-3">
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
        &larr; Back to Categories
    </a>
</div>

{{-- Create Category --}}
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h5 class="fw-bold mb-3">Create New Category</h5>

        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Category Name</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ old('name') }}"
                       placeholder="Enter category name"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description"
                          class="form-control"
                          rows="3"
                          placeholder="Enter description">{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                Save Category
            </button>
        </form>
    </div>
</div>

{{-- Create Subcategory --}}
<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="fw-bold mb-3">Create New Subcategory</h5>

        @if ($categories->isEmpty())
            <div class="alert alert-warning mb-0">
                Please create a category first. Then you can add its subcategories.
            </div>
        @else
            <form id="subcategoryForm" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="category_id" class="form-label">Select Parent Category</label>

                    <select id="category_id" class="form-select" required>
                        <option value="">Select category</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Subcategory Name</label>
                    <input type="text"
                           name="name"
                           class="form-control"
                           placeholder="Enter subcategory name"
                           required>
                </div>

                <button type="submit" class="btn btn-success">
                    Save Subcategory
                </button>
            </form>

            <script>
                const categorySelect = document.getElementById('category_id');
                const subcategoryForm = document.getElementById('subcategoryForm');

                function updateSubcategoryAction() {
                    if (categorySelect.value) {
                        subcategoryForm.action =
                            "{{ url('/admin/categories') }}/" +
                            encodeURIComponent(categorySelect.value) +
                            "/subcategories";
                    } else {
                        subcategoryForm.removeAttribute('action');
                    }
                }

                categorySelect.addEventListener('change', updateSubcategoryAction);
                updateSubcategoryAction();

                subcategoryForm.addEventListener('submit', function (event) {
                    if (!categorySelect.value) {
                        event.preventDefault();
                        alert('Please select a parent category.');
                    }
                });
            </script>
        @endif
    </div>
</div>

@endsection
