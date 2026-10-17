
@extends('admin.sidebar')

@section('content')
@php
    $editing = $item->exists;
@endphp

<div class="container-fluid py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>{{ $editing ? 'Edit News' : 'Add New News' }}</h3>
        <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
            All News
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Please check these fields:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ $editing ? route('admin.news.update', $item->id) : route('admin.news.store') }}"
        method="POST"
        enctype="multipart/form-data"
        id="newsForm"
    >
        @csrf
        @if ($editing)
            @method('PUT')
        @endif

        <div class="card mb-4">
            <div class="card-header fw-bold">1. Basic News Details</div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">News Heading (H1) *</label>
                        <input type="text" name="title" id="newsTitle"
                               class="form-control" required maxlength="255"
                               value="{{ old('title', $item->title) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">URL Slug</label>
                        <input type="text" name="slug" id="newsSlug"
                               class="form-control"
                               value="{{ old('slug', $item->slug) }}"
                               placeholder="news-heading">
                        <small class="text-muted">Example: latest-news-update</small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Category *</label>
                        <select name="category_id" id="categorySelect"
                                class="form-select" required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    @selected(old('category_id', $item->category_id) == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Subcategory (Optional)</label>
                        <select name="subcategory_id" id="subcategorySelect"
                                class="form-select">
                            <option value="">Select Subcategory</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Short Description / Excerpt</label>
                        <textarea name="excerpt" class="form-control" rows="3"
                                  maxlength="1000">{{ old('excerpt', $item->excerpt) }}</textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Full News Content *</label>
                        <div id="editor" style="min-height:300px;background:#fff"></div>
                        <textarea name="content" id="contentField" hidden>{{ old('content', $item->content) }}</textarea>
                        <small class="text-muted">
                            Editor mein bold, italic, headings, lists aur links add kar sakte hain.
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header fw-bold">2. Image and Video</div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Featured Image</label>
                        <input type="file" name="featured_image" class="form-control"
                               accept=".jpg,.jpeg,.png,.webp">
                        <small class="text-muted">JPG, PNG, WebP; maximum 5 MB.</small>

                        @if ($editing && $item->featured_image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $item->featured_image) }}"
                                     alt="Current featured image"
                                     style="max-width:180px;max-height:120px;object-fit:cover">
                            </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Image Alt Text</label>
                        <input type="text" name="image_alt" class="form-control"
                               value="{{ old('image_alt', $item->image_alt) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">YouTube Video URL</label>
                        <input type="url" name="youtube_url" class="form-control"
                               placeholder="https://www.youtube.com/watch?v=..."
                               value="{{ old('youtube_url', $item->youtube_url) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Facebook Video / Post URL</label>
                        <input type="url" name="facebook_url" class="form-control"
                               placeholder="https://www.facebook.com/..."
                               value="{{ old('facebook_url', $item->facebook_url) }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header fw-bold">3. SEO Details</div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Meta Title</label>
                        <input type="text" name="meta_title" class="form-control"
                               maxlength="255"
                               value="{{ old('meta_title', $item->meta_title) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Focus Keyword</label>
                        <input type="text" name="focus_keyword" class="form-control"
                               value="{{ old('focus_keyword', $item->focus_keyword) }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Meta Description</label>
                        <textarea name="meta_description" class="form-control" rows="3"
                                  maxlength="500">{{ old('meta_description', $item->meta_description) }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Canonical URL</label>
                        <input type="url" name="canonical_url" class="form-control"
                               value="{{ old('canonical_url', $item->canonical_url) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Open Graph Image URL</label>
                        <input type="url" name="og_image" class="form-control"
                               value="{{ old('og_image', $item->og_image) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Open Graph Title</label>
                        <input type="text" name="og_title" class="form-control"
                               value="{{ old('og_title', $item->og_title) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Open Graph Description</label>
                        <textarea name="og_description" class="form-control" rows="2"
                                  maxlength="500">{{ old('og_description', $item->og_description) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header fw-bold">4. Publishing and Breaking News</div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-select" required>
                            @foreach (['draft' => 'Draft', 'published' => 'Published', 'scheduled' => 'Scheduled'] as $value => $label)
                                <option value="{{ $value }}"
                                    @selected(old('status', $item->status ?: 'draft') === $value)>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Publish Date & Time</label>
                        <input type="datetime-local" name="published_at"
                               class="form-control"
                               value="{{ old('published_at', $item->published_at ? $item->published_at->format('Y-m-d\TH:i') : '') }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Breaking News Pin Order</label>
                        <input type="number" name="pin_order" min="0"
                               class="form-control"
                               value="{{ old('pin_order', $item->pin_order ?? 0) }}">
                        <small class="text-muted">Smaller number appears first among pinned news.</small>
                    </div>

                    <div class="col-12">
                        <div class="form-check">
                            <input type="checkbox" name="is_pinned" value="1"
                                   id="isPinned" class="form-check-input"
                                   @checked(old('is_pinned', $item->is_pinned))>
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

<link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const initialContent = @json(old('content', $item->content ?? ''));
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

    quill.root.innerHTML = initialContent || '';
    document.getElementById('newsForm').addEventListener('submit', function () {
        document.getElementById('contentField').value = quill.root.innerHTML;
    });

    const categoryData = @json($categories->map(fn ($category) => [
        'id' => $category->id,
        'subcategories' => $category->subcategories->map(fn ($sub) => [
            'id' => $sub->id,
            'name' => $sub->name
        ])->values()
    ])->values());

    const categorySelect = document.getElementById('categorySelect');
    const subcategorySelect = document.getElementById('subcategorySelect');
    const selectedSubcategory = @json((string) old('subcategory_id', $item->subcategory_id ?? ''));

    function loadSubcategories() {
        const selectedCategory = categoryData.find(
            category => String(category.id) === categorySelect.value
        );

        subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';

        if (!selectedCategory) return;

        selectedCategory.subcategories.forEach(function (sub) {
            const option = document.createElement('option');
            option.value = sub.id;
            option.textContent = sub.name;
            if (String(sub.id) === String(selectedSubcategory)) {
                option.selected = true;
            }
            subcategorySelect.appendChild(option);
        });
    }

    categorySelect.addEventListener('change', function () {
        subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';
        const selectedCategory = categoryData.find(
            category => String(category.id) === categorySelect.value
        );

        if (!selectedCategory) return;

        selectedCategory.subcategories.forEach(function (sub) {
            const option = document.createElement('option');
            option.value = sub.id;
            option.textContent = sub.name;
            subcategorySelect.appendChild(option);
        });
    });

    loadSubcategories();

    const titleInput = document.getElementById('newsTitle');
    const slugInput = document.getElementById('newsSlug');
    let slugManuallyEdited = Boolean(slugInput.value);

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
