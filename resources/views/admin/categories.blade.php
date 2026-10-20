@extends('admin.sidebar')

@section('title', 'Categories Management')

@section('content')

<style>
    .categories-page {
        width: 100%;
        min-width: 0;
    }

    .categories-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 18px;
    }

    .categories-header h2 {
        color: #15213b;
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .categories-header p {
        color: #737b8b;
        font-size: 12px;
        margin: 0;
    }

    .btn-brand {
        display: inline-block;
        background: #ed101b;
        color: #fff;
        border: 1px solid #ed101b;
        border-radius: 5px;
        padding: 8px 11px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
    }

    .btn-brand:hover {
        background: #c80913;
        color: #fff;
    }

    /* Main category grid */
    .category-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
        align-items: start;
    }

    .category-card {
        min-width: 0;
        background: #fff;
        border: 1px solid #e5e8ef;
        border-top: 3px solid #1239c5;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 7px rgba(21, 33, 59, .04);
    }

    .category-card-header {
        padding: 12px;
        border-bottom: 1px solid #e8eaf0;
    }

    .category-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 8px;
    }

    .category-name {
        color: #15213b;
        font-size: 15px;
        font-weight: 700;
        margin: 0 0 4px;
        overflow-wrap: anywhere;
    }

    .category-slug {
        color: #818899;
        font-size: 10px;
        overflow-wrap: anywhere;
    }

    .category-description {
        color: #626b7c;
        font-size: 11px;
        line-height: 1.5;
        margin: 7px 0 0;
        overflow-wrap: anywhere;
    }

    .category-actions,
    .subcategory-actions {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 5px;
    }

    .category-actions form,
    .subcategory-actions form {
        margin: 0;
    }

    .btn-xs {
        padding: 4px 6px;
        font-size: 10px;
        line-height: 1.3;
        border-radius: 4px;
    }

    .category-card-body {
        padding: 12px;
    }

    .subcategories-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 6px;
        margin-bottom: 9px;
    }

    .subcategories-heading h6 {
        color: #343c4e;
        font-size: 11px;
        font-weight: 700;
        margin: 0;
    }

    .subcategory-count {
        background: #edf1ff;
        color: #1239c5;
        border-radius: 20px;
        padding: 3px 7px;
        font-size: 10px;
        font-weight: 700;
    }

    /* Subcategory grid */
    .subcategory-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 7px;
    }

    .subcategory-item {
        min-width: 0;
        padding: 8px;
        background: #f7f8fc;
        border: 1px solid #e9ebf2;
        border-radius: 5px;
    }

    .subcategory-item-name {
        color: #3c4557;
        font-size: 11px;
        font-weight: 600;
        line-height: 1.4;
        overflow-wrap: anywhere;
        margin-bottom: 7px;
    }

    .empty-subcategories {
        grid-column: 1 / -1;
        padding: 10px 5px;
        text-align: center;
        color: #858c9a;
        background: #f7f8fc;
        border-radius: 5px;
        font-size: 11px;
    }

    .subcategory-edit-form {
        grid-column: 1 / -1;
        padding: 10px;
        background: #f5f7ff;
        border: 1px solid #dfe5ff;
        border-radius: 6px;
    }

    .subcategory-edit-form label,
    .add-subcategory label {
        display: block;
        color: #525b6d;
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .subcategory-edit-form .form-control,
    .add-subcategory .form-control {
        min-width: 0;
        font-size: 11px;
    }

    .subcategory-edit-form .btn,
    .add-subcategory .btn {
        font-size: 10px;
    }

    .add-subcategory {
        border-top: 1px solid #e8ebf1;
        margin-top: 12px;
        padding-top: 11px;
    }

    .empty-categories {
        padding: 30px 15px;
        background: #fff;
        border: 1px solid #e5e8ef;
        border-radius: 8px;
        text-align: center;
        color: #737b8b;
    }

    /* Tablet: 2 cards */
    @media (max-width: 1050px) {
        .category-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }
    }

    /* Mobile: keep 2 compact cards per row */
    @media (max-width: 600px) {
        .categories-header h2 {
            font-size: 20px;
        }

        .category-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 8px;
        }

        .category-card-header,
        .category-card-body {
            padding: 9px;
        }

        .category-name {
            font-size: 13px;
        }

        .category-actions {
            gap: 4px;
        }

        .subcategory-grid {
            grid-template-columns: 1fr;
        }

        .btn-xs {
            padding: 4px 5px;
            font-size: 9px;
        }

        .add-subcategory .input-group {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }

        .add-subcategory .input-group .form-control {
            width: 100%;
            border-radius: 4px !important;
        }

        .add-subcategory .input-group .btn {
            border-radius: 4px !important;
        }
    }

    /* Very narrow phones */
    @media (max-width: 350px) {
        .category-grid {
            grid-template-columns: 1fr;
        }

        .subcategory-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }
</style>

<div class="categories-page">

    {{-- Heading --}}
    <div class="categories-header">
        <div>
            <h2>Categories Management</h2>
            <p>Manage your news categories and subcategories.</p>
        </div>

        <a href="{{ route('admin.categories.create') }}"
           class="btn-brand">
            + Add Category
        </a>
    </div>

    {{-- Success message --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    @if ($categories->isEmpty())

        <div class="empty-categories">
            <h5>No categories found</h5>
            <p>Create your first category to organise news.</p>

            <a href="{{ route('admin.categories.create') }}"
               class="btn-brand">
                + Add Category
            </a>
        </div>

    @else

        {{-- IMPORTANT: one shared grid for every category --}}
        <div class="category-grid">

            @foreach ($categories as $category)

                <div class="category-card">

                    {{-- Category details --}}
                    <div class="category-card-header">

                        <div class="category-top">
                            <div style="min-width: 0;">
                                <h3 class="category-name">
                                    {{ $category->name }}
                                </h3>

                                <div class="category-slug">
                                    /{{ $category->slug }}
                                </div>
                            </div>

                            <div class="category-actions">

                                <a href="{{ route('admin.categories.edit', $category) }}"
                                   class="btn btn-outline-primary btn-xs">
                                    Edit
                                </a>

                                <form action="{{ route('admin.categories.destroy', $category) }}"
                                      method="POST"
                                      onsubmit="return confirm('Delete this category?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-outline-danger btn-xs">
                                        Delete
                                    </button>
                                </form>

                            </div>
                        </div>

                        @if ($category->description)
                            <p class="category-description">
                                {{ $category->description }}
                            </p>
                        @endif

                    </div>

                    {{-- Subcategories --}}
                    <div class="category-card-body">

                        <div class="subcategories-heading">
                            <h6>Subcategories</h6>

                            <span class="subcategory-count">
                                {{ $category->subcategories->count() }}
                            </span>
                        </div>

                        <div class="subcategory-grid">

                            @forelse ($category->subcategories as $subcategory)

                                <div class="subcategory-item">

                                    <div class="subcategory-item-name">
                                        {{ $subcategory->name }}
                                    </div>

                                    <div class="subcategory-actions">

                                        <a href="{{ route('admin.categories.index', ['edit_subcategory' => $subcategory->id]) }}"
                                           class="btn btn-outline-primary btn-xs">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.subcategories.destroy', $subcategory) }}"
                                              method="POST"
                                              onsubmit="return confirm('Delete this subcategory?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-outline-danger btn-xs">
                                                Delete
                                            </button>
                                        </form>

                                    </div>
                                </div>

                                {{-- Inline edit --}}
                                @if ($editSubcategory && $editSubcategory->id == $subcategory->id)

                                    <div class="subcategory-edit-form">

                                        <form action="{{ route('admin.subcategories.update', $subcategory) }}"
                                              method="POST">
                                            @csrf
                                            @method('PUT')

                                            <label>Edit Subcategory Name</label>

                                            <div class="input-group input-group-sm">
                                                <input type="text"
                                                       name="name"
                                                       class="form-control"
                                                       value="{{ old('name', $subcategory->name) }}"
                                                       required>

                                                <button type="submit"
                                                        class="btn btn-primary">
                                                    Update
                                                </button>

                                                <a href="{{ route('admin.categories.index') }}"
                                                   class="btn btn-secondary">
                                                    Cancel
                                                </a>
                                            </div>
                                        </form>

                                    </div>

                                @endif

                            @empty

                                <div class="empty-subcategories">
                                    No subcategories yet.
                                </div>

                            @endforelse

                        </div>

                        {{-- Add subcategory --}}
                        <form action="{{ route('admin.categories.subcategories.store', $category) }}"
                              method="POST"
                              class="add-subcategory">
                            @csrf

                            <label>
                                Add to {{ $category->name }}
                            </label>

                            <div class="input-group input-group-sm">
                                <input type="text"
                                       name="name"
                                       class="form-control"
                                       placeholder="Subcategory name"
                                       required>

                                <button type="submit"
                                        class="btn btn-primary">
                                    + Add
                                </button>
                            </div>
                        </form>

                    </div>

                </div>

            @endforeach

        </div>

    @endif

</div>

@endsection