
@extends('admin.sidebar')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>All News</h3>
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
            + Add New News
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            Please check the form for errors.
        </div>
    @endif

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
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
                                <strong>{{ $item->title }}</strong>
                                <div class="small text-muted">{{ $item->slug }}</div>
                            </td>

                            <td>{{ $item->author_name ?: '—' }}</td>

                            <td>
                                {{ $item->category?->name ?? '—' }}
                                @if ($item->subcategory)
                                    <div class="small text-muted">
                                        {{ $item->subcategory->name }}
                                    </div>
                                @endif
                            </td>

                            <td>
                                @if ($item->status === 'published')
                                    <span class="badge bg-success">Published</span>
                                @else
                                    <span class="badge bg-secondary">Draft</span>
                                @endif
                            </td>

                            <td>
                                @if ($item->is_pinned)
                                    <span class="badge bg-danger">Pinned</span>
                                    <div class="small">Order: {{ $item->pin_order }}</div>
                                @else
                                    —
                                @endif
                            </td>

                            <td>
                                {{ $item->published_at?->format('d M Y, h:i A') ?? '—' }}
                            </td>

                            <td style="min-width:130px">
                                <a
                                    href="{{ route('admin.news.edit', $item->id) }}"
                                    class="btn btn-sm btn-warning mb-1"
                                >
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

                                    <button type="submit" class="btn btn-sm btn-danger mb-1">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                No news found. Click “Add New News” to create one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $news->links() }}
        </div>
    </div>
</div>
@endsection
