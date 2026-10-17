
@extends('admin.sidebar')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Dashboard</h2>
        <p class="text-secondary mb-0">
            Welcome to NewsBharti Admin Panel
        </p>
    </div>

    <span class="badge text-bg-primary p-2">
        Local Development
    </span>
</div>

<div class="row g-3 mb-4">

    @php
        $cards = [
            ['Total News', $totalNews, 'primary'],
            ['Published', $publishedNews, 'success'],
            ['Drafts', $draftNews, 'warning'],
            ['Scheduled', $scheduledNews, 'info'],
            ['Categories', $totalCategories, 'primary'],
            ['Subcategories', $totalSubcategories, 'secondary'],
            ['Pinned News', $pinnedNews, 'danger'],
        ];
    @endphp

    @foreach ($cards as [$label, $count, $color])
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card h-100">
                <div class="card-body">
                    <div class="text-secondary mb-2">
                        {{ $label }}
                    </div>

                    <div class="stat-number text-{{ $color }}">
                        {{ number_format($count) }}
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</div>

<div class="card stat-card">
    <div class="card-body">
        <h5 class="fw-bold mb-3">Recently Added News</h5>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Heading</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Published At</th>
                        <th>Pinned</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($latestNews as $item)
                        <tr>
                            <td>{{ $item->title }}</td>

                            <td>
                                {{ $item->category_name ?? 'Unassigned' }}
                            </td>

                            <td>
                                <span class="badge text-bg-secondary">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>

                            <td>
                                {{ $item->published_at
                                    ? \Illuminate\Support\Carbon::parse($item->published_at)->format('d M Y, h:i A')
                                    : 'Not published' }}
                            </td>

                            <td>
                                {{ $item->is_pinned ? 'Yes' : 'No' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-secondary py-4">
                                No news added yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
