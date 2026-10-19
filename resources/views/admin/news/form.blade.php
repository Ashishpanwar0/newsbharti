
@extends('admin.sidebar')

@section('content')
@php
    $editing = $item->exists;
@endphp

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>{{ $editing ? 'Edit News' : 'Add New News' }}</h3>
        <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
            All News
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Please correct the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        id="newsForm"
        action="{{ $editing ? route('admin.news.update', $item->id) : route('admin.news.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf
        @if ($editing)
            @method('PUT')
        @endif

        {{-- Basic Details --}}
        <div class="card mb-4">
            <div class="card-header fw-bold">Basic News Details</div>
            <div class="card-body">
                <div class="row g-3">

                    <div class="col-md-8">
                        <label class="form-label">News Heading (H1) *</label>
                        <input
                            type="text"
                            name="title"
                            id="newsTitle"
                            class="form-control"
                            maxlength="255"
                            required
                            value="{{ old('title', $item->title) }}"
                        >
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Author Name</label>
                        <input
                            type="text"
                            name="author_name"
                            class="form-control"
                            maxlength="255"
                            value="{{ old('author_name', $item->author_name) }}"
                            placeholder="Enter author name"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">URL Slug</label>
                        <input
                            type="text"
                            name="slug"
                            id="newsSlug"
                            class="form-control"
                            maxlength="255"
                            value="{{ old('slug', $item->slug) }}"
                            placeholder="news-heading"
                        >
                        <small class="text-muted">
                            Example: latest-news-update
                        </small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Category *</label>
                        <select
                            name="category_id"
                            id="categorySelect"
                            class="form-select"
                            required
                        >
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option
                                    value="{{ $category->id }}"
                                    @selected((string) old('category_id', $item->category_id) === (string) $category->id)
                                >
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Subcategory</label>
                        <select
                            name="subcategory_id"
                            id="subcategorySelect"
                            class="form-select"
                        >
                            <option value="">Select Subcategory</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Short Description</label>
                        <textarea
                            name="excerpt"
                            class="form-control"
                            rows="3"
                            maxlength="1000"
                        >{{ old('excerpt', $item->excerpt) }}</textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Full News Content *</label>
                        <div id="editor" style="min-height:300px;background:#fff"></div>
                        <textarea
                            name="content"
                            id="contentField"
                            hidden
                        >{{ old('content', $item->content) }}</textarea>
                        <small class="text-muted">
                            Use headings, bold, italic, lists, blockquotes and links in the editor.
                        </small>
                    </div>

                </div>
            </div>
        </div>

        {{-- Image and Videos --}}
        <div class="card mb-4">
            <div class="card-header fw-bold">Image and Video</div>
            <div class="card-body">
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Featured Image</label>
                        <input
                            type="file"
                            name="featured_image"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp"
                        >
                        <small class="text-muted">JPG, PNG or WebP; maximum 5 MB.</small>

                        @if ($editing && $item->featured_image)
                            <div class="mt-3">
                                <img
                                    src="{{ asset('storage/' . $item->featured_image) }}"
                                    alt="{{ $item->image_alt ?: $item->title }}"
                                    style="max-width:200px;max-height:140px;object-fit:cover"
                                >
                            </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Image Alt Text</label>
                        <input
                            type="text"
                            name="image_alt"
                            class="form-control"
                            maxlength="255"
                            value="{{ old('image_alt', $item->image_alt) }}"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">YouTube Video URL</label>
                        <input
                            type="url"
                            name="youtube_url"
                            class="form-control"
                            placeholder="https://www.youtube.com/watch?v=..."
                            value="{{ old('youtube_url', $item->youtube_url) }}"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Facebook Video / Post URL</label>
                        <input
                            type="url"
                            name="facebook_url"
                            class="form-control"
                            placeholder="https://www.facebook.com/..."
                            value="{{ old('facebook_url', $item->facebook_url) }}"
                        >
                    </div>

                </div>
            </div>
        </div>

        {{-- SEO --}}
        <div class="card mb-4">
            <div class="card-header fw-bold">SEO Details</div>
            <div class="card-body">
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Meta Title</label>
                        <input
                            type="text"
                            name="meta_title"
                            class="form-control"
                            maxlength="255"
                            value="{{ old('meta_title', $item->meta_title) }}"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Focus Keyword</label>
                        <input
                            type="text"
                            name="focus_keyword"
                            class="form-control"
                            value="{{ old('focus_keyword', $item->focus_keyword) }}"
                        >
                    </div>

                    <div class="col-12">
                        <label class="form-label">Meta Description</label>
                        <textarea
                            name="meta_description"
                            class="form-control"
                            rows="3"
                            maxlength="500"
                        >{{ old('meta_description', $item->meta_description) }}</textarea>
                    </div>

                </div>
            </div>
        </div>

        {{-- Publishing --}}
        <div class="card mb-4">
            <div class="card-header fw-bold">Publishing and Breaking News</div>
            <div class="card-body">
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-select" required>
                            <option
                                value="draft"
                                @selected(old('status', $item->status ?: 'draft') === 'draft')
                            >
                                Draft
                            </option>
                            <option
                                value="published"
                                @selected(old('status', $item->status ?: 'draft') === 'published')
                            >
                                Published
                            </option>
                        </select>
                        <small class="text-muted">
                            Published news gets the current date and time automatically.
                        </small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Pin Order</label>
                        <input
                            type="number"
                            name="pin_order"
                            class="form-control"
                            min="0"
                            value="{{ old('pin_order', $item->pin_order ?? 0) }}"
                        >
                        <small class="text-muted">
                            Lower numbers appear first among pinned news.
                        </small>
                    </div>

                    <div class="col-12">
                        <div class="form-check">
                            <input
                                type="checkbox"
                                name="is_pinned"
                                id="isPinned"
                                class="form-check-input"
                                value="1"
                                @checked(old('is_pinned', $item->is_pinned))
                            >
                            <label for="isPinned" class="form-check-label">
                                Pin as Breaking News
                            </label>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-lg">
            {{ $editing ? 'Update News' : 'Save News' }}
        </button>

        <a href="{{ route('admin.news.index') }}" class="btn btn-secondary btn-lg">
            Cancel
        </a>
    </form>
</div>

<link
    href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css"
    rel="stylesheet"
>
<script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const contentField = document.getElementById('contentField');

    const quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, false] }],
                ['bold', 'italic', 'underline'],
                [{ list: 'ordered' }, { list: 'bullet' }],
                ['link', 'blockquote'],
                ['clean']
            ]
        }
    });

    quill.root.innerHTML = contentField.value || '';

    document.getElementById('newsForm').addEventListener('submit', function () {
        contentField.value = quill.root.innerHTML;
    });

    const categoryData = @json(
        $categories->map(fn ($category) => [
            'id' => $category->id,
            'subcategories' => $category->subcategories->map(fn ($sub) => [
                'id' => $sub->id,
                'name' => $sub->name
            ])->values()
        ])->values()
    );

    const categorySelect = document.getElementById('categorySelect');
    const subcategorySelect = document.getElementById('subcategorySelect');
    const selectedSubcategory = @json(
        (string) old('subcategory_id', $item->subcategory_id ?? '')
    );

    function loadSubcategories(restoreSelected = false) {
        subcategorySelect.innerHTML =
            '<option value="">Select Subcategory</option>';

        const category = categoryData.find(
            item => String(item.id) === categorySelect.value
        );

        if (!category) return;

        category.subcategories.forEach(function (sub) {
            const option = document.createElement('option');
            option.value = sub.id;
            option.textContent = sub.name;

            if (restoreSelected && String(sub.id) === selectedSubcategory) {
                option.selected = true;
            }

            subcategorySelect.appendChild(option);
        });
    }

    categorySelect.addEventListener('change', function () {
        loadSubcategories(false);
    });

    loadSubcategories(true);

    const titleInput = document.getElementById('newsTitle');
    const slugInput = document.getElementById('newsSlug');
    let slugManuallyEdited = slugInput.value.trim() !== '';

    slugInput.addEventListener('input', function () {
        slugManuallyEdited = true;
    });

    titleInput.addEventListener('input', function () {
        if (!slugManuallyEdited) {
            slugInput.value = titleInput.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
        }
    });
});
</script>
@endsection
