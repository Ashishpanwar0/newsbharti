@extends('admin.sidebar')

@section('title', 'All News | Samachar Bharti')

@section('content')

<style>
    .news-index-page { width: 100%; min-width: 0; }

    .news-index-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 24px;
    }

    .news-index-heading h1 {
        color: #15213b;
        font-size: 27px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .news-index-heading p {
        color: #737b8b;
        font-size: 13px;
        margin: 0;
    }

    .news-add-btn {
        background: #ed101b;
        color: #fff;
        border: 1px solid #ed101b;
        border-radius: 6px;
        padding: 10px 15px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
    }

    .news-add-btn:hover { background: #c80913; color: #fff; }

    .news-index-panel {
        background: #fff;
        border: 1px solid #e5e8ef;
        border-radius: 8px;
        overflow: hidden;
    }

    .news-index-table {
        width: 100%;
        min-width: 800px;
        margin: 0;
    }

    .news-index-table thead th {
        background: #f5f6fa;
        color: #656e80;
        font-size: 11px;
        text-transform: uppercase;
        padding: 14px 17px;
        white-space: nowrap;
        border-bottom: 1px solid #e5e8ef;
    }

    .news-index-table tbody td {
        color: #4b5363;
        font-size: 13px;
        padding: 15px 17px;
        vertical-align: middle;
        border-bottom: 1px solid #e5e8ef;
    }

    .news-title {
        color: #252b38;
        font-weight: 600;
        max-width: 280px;
        overflow-wrap: anywhere;
    }

    .news-slug {
        color: #737b8b;
        font-size: 12px;
        margin-top: 3px;
    }

    .news-date { white-space: nowrap; font-size: 12px; }

    .news-edit-btn {
        display: inline-block;
        color: #1239c5;
        border: 1px solid #1239c5;
        border-radius: 5px;
        padding: 5px 10px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        margin-right: 4px;
        margin-bottom: 4px;
    }

    .news-edit-btn:hover { background: #1239c5; color: #fff; }

    .news-delete-btn {
        display: inline-block;
        color: #ed101b;
        border: 1px solid #ed101b;
        border-radius: 5px;
        padding: 5px 10px;
        font-size: 12px;
        font-weight: 600;
        background: #fff;
        margin-bottom: 4px;
    }

    .news-delete-btn:hover { background: #ed101b; color: #fff; }

    .news-alert-success {
        background: #d1e7dd;
        border: 1px solid #badbcc;
        color: #0f5132;
        border-radius: 8px;
        padding: 12px 16px;
        margin-bottom: 20px;
        font-size: 13px;
    }

    .news-alert-danger {
        background: #f8d7da;
        border: 1px solid #f5c2c7;
        color: #842029;
        border-radius: 8px;
        padding: 12px 16px;
        margin-bottom: 20px;
        font-size: 13px;
    }

    .news-index-footer {
        border-top: 1px solid #e5e8ef;
        padding: 13px 20px;
    }

    @media (max-width: 767px) {
        .news-index-heading h1 { font-size: 23px; }
    }
</style>

<div class="news-index-page">

    <div class="news-index-heading">
        <div>
            <h1>All News</h1>
            <p>Manage and edit your news articles.</p>
        </div>
        <a href="{{ route('admin.news.create') }}" class="news-add-btn">
            + Add New News
        </a>
    </div>

    @if (session('success'))
        <div class="news-alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="news-alert-danger">Please check the form for errors.</div>
    @endif

    <div class="news-index-panel">
        <div class="table-responsive">
            <table class="table table-hover news-index-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>News</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Breaking</th>
                        <th>Publish Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($news as $item)
                        <tr>
                            <td>{{ $news->firstItem() + $loop->index }}</td>
                            <td>
                                <div class="news-title">{{ $item->title }}</div>
                                <div class="news-slug">{{ $item->slug }}</div>
                            </td>
                            <td>{{ $item->author_name ?: '—' }}</td>
                            <td>
                                {{ $item->category?->name ?? '—' }}
                                @if ($item->subcategory)
                                    <div class="news-slug">{{ $item->subcategory->name }}</div>
                                @endif
                            </td>
                            <td>
                                @if ($item->status === 'published')
                                    <span class="badge text-bg-success">Published</span>
                                @else
                                    <span class="badge text-bg-secondary">Draft</span>
                                @endif
                            </td>
                            <td>
                                @if ($item->is_pinned)
                                    <span class="badge text-bg-danger">Pinned</span>
                                    <div class="news-slug">Order: {{ $item->pin_order }}</div>
                                @else
                                    —
                                @endif
                            </td>
                            <td>
                                <span class="news-date">
                                    {{ $item->published_at?->format('d M Y, h:i A') ?? '—' }}
                                </span>
                            </td>
                            <td style="min-width:130px">
                                <a href="{{ route('admin.news.edit', $item->id) }}" class="news-edit-btn">
                                    Edit
                                </a>
                                <form
                                    action="{{ route('admin.news.destroy', $item->id) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this news?')"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="news-delete-btn">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-secondary py-5">
                                No news found. Click “Add New News” to create one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($news->hasPages())
            <div class="news-index-footer">
                {{ $news->links() }}
            </div>
        @endif
    </div>

</div>

@endsection