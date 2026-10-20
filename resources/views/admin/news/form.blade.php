@extends('admin.sidebar')

@section('title', ($item->exists ? 'Edit News' : 'Add New News') . ' | Samachar Bharti')

@section('content')

<style>
    .news-form-page {
        width: 100%;
        min-width: 0;
    }

    .news-form-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 24px;
    }

    .news-form-heading h1 {
        color: #15213b;
        font-size: 27px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .news-form-heading p {
        color: #737b8b;
        font-size: 13px;
        margin: 0;
    }

    .news-back-btn {
        color: #1239c5;
        border: 1px solid #1239c5;
        border-radius: 6px;
        padding: 10px 15px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        background: #fff;
    }

    .news-back-btn:hover {
        color: #fff;
        background: #1239c5;
    }

    .news-form-card {
        background: #fff;
        border: 1px solid #e5e8ef;
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 24px;
    }

    .news-form-card-header {
        padding: 16px 21px;
        border-bottom: 1px solid #e5e8ef;
        background: #f5f6fa;
        font-size: 15px;
        font-weight: 700;
        color: #15213b;
    }

    .news-form-card-body {
        padding: 21px;
    }

    .news-form-label {
        color: #4b5363;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 6px;
    }

    .news-form-page .form-control,
    .news-form-page .form-select {
        border: 1px solid #e5e8ef;
        border-radius: 6px;
        font-size: 13px;
        color: #252b38;
        padding: 10px 12px;
    }

    .news-form-page .form-control:focus,
    .news-form-page .form-select:focus {
        border-color: #1239c5;
        box-shadow: 0 0 0 0.2rem rgba(18, 57, 197, 0.15);
    }

    .news-form-page .form-control::placeholder {
        color: #a0a7b5;
    }

    .news-form-hint {
        color: #737b8b;
        font-size: 12px;
        margin-top: 5px;
        display: block;
    }

    .news-form-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 8px;
    }

    .news-submit-btn {
        background: #ed101b;
        color: #fff;
        border: 1px solid #ed101b;
        border-radius: 6px;
        padding: 12px 22px;
        font-size: 14px;
        font-weight: 600;
    }

    .news-submit-btn:hover {
        background: #c80913;
        border-color: #c80913;
        color: #fff;
    }

    .news-cancel-btn {
        background: #fff;
        color: #656e80;
        border: 1px solid #e5e8ef;
        border-radius: 6px;
        padding: 12px 22px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
    }

    .news-cancel-btn:hover {
        background: #f5f6fa;
        color: #15213b;
        border-color: #d0d5e0;
    }

    .news-alert {
        border-radius: 8px;
        border: 1px solid #f5c2c7;
        background: #f8d7da;
        color: #842029;
        padding: 14px 18px;
        margin-bottom: 24px;
        font-size: 13px;
    }

    .news-form-page .form-check-input:checked {
        background-color: #1239c5;
        border-color: #1239c5;
    }

    .news-form-page .form-check-label {
        color: #4b5363;
        font-size: 13px;
    }

    #editor {
        min-height: 300px;
        background: #fff;
        border: 1px solid #e5e8ef;
        border-radius: 0 0 6px 6px;
    }

    .ql-toolbar.ql-snow {
        border: 1px solid #e5e8ef;
        border-radius: 6px 6px 0 0;
        background: #f5f6fa;
    }

    .ql-container.ql-snow {
        border: 1px solid #e5e8ef;
        border-top: 0;
        border-radius: 0 0 6px 6px;
    }

    @media (max-width: 767px) {
        .news-form-heading h1 {
            font-size: 23px;
        }

        .news-form-card-body {
            padding: 16px;
        }

        .news-form-card-header {
            padding: 14px 16px;
        }
    }
</style>

@php
    $editing = $item->exists;
@endphp

<div class="news-form-page">

    {{-- Heading --}}
    <div class="news-form-heading">
        <div>
            <h1>{{ $editing ? 'Edit News' : 'Add New News' }}</h1>
            <p>{{ $editing ? 'Update existing news article.' : 'Create and publish a new news article.' }}</p>
        </div>

        <a href="{{ route('admin.news.index') }}" class="news-back-btn">
            All News
        </a>
    </div>

    @if ($errors->any())
        <div class="news-alert">
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
        <div class="news-form-card">
            <div class="news-form-card-header">Basic News Details</div>
            <div class="news-form-card-body">
                <div class="row g-3">

                    <div class="col-md-8">
                        <label class="news-form-label">News Heading (H1) *</label>
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
                        <label class="news-form-label">Author Name</label>
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
                        <label class="news-form-label">URL slug</label>
                        <input
                            type="text"
                            name="slug"
                            id="newsSlug"
                            class="form-control"
                            maxlength="255"
                            value="{{ old('slug', $item->slug) }}"
                            placeholder="news-heading"
                        >
                        <span class="news-form-hint">Example: latest-news-update</span>
                    </div>

                    <div class="col-md-6">
                        <label class="news-form-label">Category *</label>
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
                        <label class="news-form-label">Subcategory</label>
                        <select
                            name="subcategory_id"
                            id="subcategorySelect"
                            class="form-select"
                        >
                            <option value="">Select Subcategory</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="news-form-label">Short Description</label>
                        <textarea
                            name="excerpt"
                            class="form-control"
                            rows="3"
                            maxlength="1000"
                        >{{ old('excerpt', $item->excerpt) }}</textarea>
                    </div>

                    <div class="col-12">
                        <label class="news-form-label">Full News Content *</label>
                        <div id="editor"></div>
                        <textarea
                            name="content"
                            id="contentField"
                            hidden
                        >{{ old('content', $item->content) }}</textarea>
                        <span class="news-form-hint">
                            Use headings, bold, italic, lists, blockquotes and links in the editor.
                        </span>
                    </div>

                </div>
            </div>
        </div>

        {{-- Image and Videos --}}
        <div class="news-form-card">
            <div class="news-form-card-header">Image and Video</div>
            <div class="news-form-card-body">
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="news-form-label">Featured Image</label>
                        <input
                            type="file"
                            name="featured_image"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp"
                        >
                        <span class="news-form-hint">JPG, PNG or WebP; maximum 5 MB.</span>

                        @if ($editing && $item->featured_image)
                            <div class="mt-3">
                                <img
                                    src="{{ asset('storage/' . $item->featured_image) }}"
                                    alt="{{ $item->image_alt ?: $item->title }}"
                                    style="max-width:200px;max-height:140px;object-fit:cover;border-radius:6px;border:1px solid #e5e8ef;"
                                >
                            </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <label class="news-form-label">Image Alt Text</label>
                        <input
                            type="text"
                            name="image_alt"
                            class="form-control"
                            maxlength="255"
                            value="{{ old('image_alt', $item->image_alt) }}"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="news-form-label">YouTube Video URL</label>
                        <input
                            type="url"
                            name="youtube_url"
                            class="form-control"
                            placeholder="https://www.youtube.com/watch?v=..."
                            value="{{ old('youtube_url', $item->youtube_url) }}"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="news-form-label">Facebook Video / Post URL</label>
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
        <div class="news-form-card">
            <div class="news-form-card-header">SEO Details</div>
            <div class="news-form-card-body">
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="news-form-label">Meta Title</label>
                        <input
                            type="text"
                            name="meta_title"
                            class="form-control"
                            maxlength="255"
                            value="{{ old('meta_title', $item->meta_title) }}"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="news-form-label">Focus Keyword</label>
                        <input
                            type="text"
                            name="focus_keyword"
                            class="form-control"
                            value="{{ old('focus_keyword', $item->focus_keyword) }}"
                        >
                    </div>

                    <div class="col-12">
                        <label class="news-form-label">Meta Description</label>
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
        <div class="news-form-card">
            <div class="news-form-card-header">Publishing and Breaking News</div>
            <div class="news-form-card-body">
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="news-form-label">Status *</label>
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
                        <span class="news-form-hint">
                            Published news gets the current date and time automatically.
                        </span>
                    </div>

                    <div class="col-md-6">
                        <label class="news-form-label">Pin Order</label>
                        <input
                            type="number"
                            name="pin_order"
                            class="form-control"
                            min="0"
                            value="{{ old('pin_order', $item->pin_order ?? 0) }}"
                        >
                        <span class="news-form-hint">
                            Lower numbers appear first among pinned news.
                        </span>
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

        <div class="news-form-actions">
            <button type="submit" class="news-submit-btn">
                {{ $editing ? 'Update News' : 'Save News' }}
            </button>

            <a href="{{ route('admin.news.index') }}" class="news-cancel-btn">
                Cancel
            </a>
        </div>
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