@extends('admin.sidebar')

@section('title', 'Dashboard | Samachar Bharti')

@section('content')

<style>
    .dashboard-page {
        width: 100%;
        min-width: 0;
    }

    .dashboard-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 24px;
    }

    .dashboard-heading h1 {
        color: #15213b;
        font-size: 27px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .dashboard-heading p {
        color: #737b8b;
        font-size: 13px;
        margin: 0;
    }

    .dashboard-add-btn {
        background: #ed101b;
        color: #fff;
        border: 1px solid #ed101b;
        border-radius: 6px;
        padding: 10px 15px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
    }

    .dashboard-add-btn:hover {
        background: #c80913;
        color: #fff;
    }

    .dashboard-stat {
        background: #fff;
        border: 1px solid #e5e8ef;
        border-top: 3px solid #1239c5;
        border-radius: 8px;
        height: 100%;
    }

    .dashboard-stat.red {
        border-top-color: #ed101b;
    }

    .dashboard-stat.green {
        border-top-color: #198754;
    }

    .dashboard-stat.orange {
        border-top-color: #e99a21;
    }

    .dashboard-stat .card-body {
        padding: 19px;
    }

    .dashboard-stat-label {
        color: #737b8b;
        font-size: 13px;
        margin-bottom: 10px;
    }

    .dashboard-stat-value {
        color: #1239c5;
        font-size: 29px;
        font-weight: 700;
        line-height: 1.2;
    }

    .dashboard-stat.red .dashboard-stat-value {
        color: #ed101b;
    }

    .dashboard-stat.green .dashboard-stat-value {
        color: #198754;
    }

    .dashboard-stat.orange .dashboard-stat-value {
        color: #b66a05;
    }

    .dashboard-news-panel {
        background: #fff;
        border: 1px solid #e5e8ef;
        border-radius: 8px;
        overflow: hidden;
    }

    .dashboard-news-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        padding: 19px 21px;
        border-bottom: 1px solid #e5e8ef;
    }

    .dashboard-news-header h2 {
        font-size: 17px;
        font-weight: 700;
        color: #15213b;
        margin-bottom: 5px;
    }

    .dashboard-news-header p {
        color: #737b8b;
        font-size: 12px;
        margin: 0;
    }

    .dashboard-view-all {
        color: #1239c5;
        border: 1px solid #1239c5;
        border-radius: 6px;
        padding: 8px 12px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
    }

    .dashboard-view-all:hover {
        color: #fff;
        background: #1239c5;
    }

    .dashboard-table {
        width: 100%;
        min-width: 700px;
        margin: 0;
    }

    .dashboard-table thead th {
        background: #f5f6fa;
        color: #656e80;
        font-size: 11px;
        text-transform: uppercase;
        padding: 14px 17px;
        white-space: nowrap;
        border-bottom: 1px solid #e5e8ef;
    }

    .dashboard-table tbody td {
        color: #4b5363;
        font-size: 13px;
        padding: 15px 17px;
        vertical-align: middle;
    }

    .dashboard-news-title {
        min-width: 180px;
        max-width: 350px;
        color: #252b38;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    .dashboard-date {
        white-space: nowrap;
        font-size: 12px;
    }

    .dashboard-footer {
        border-top: 1px solid #e5e8ef;
        padding: 13px 20px;
        color: #737b8b;
        font-size: 12px;
    }

    @media (max-width: 767px) {
        .dashboard-heading h1 {
            font-size: 23px;
        }

        .dashboard-stat .card-body {
            padding: 15px;
        }

        .dashboard-stat-value {
            font-size: 25px;
        }

        .dashboard-news-header {
            padding: 15px;
        }
    }
</style>

<div class="dashboard-page">

    {{-- Dashboard heading --}}
    <div class="dashboard-heading">
        <div>
            <h1>Dashboard</h1>
            <p>Manage your news and publications.</p>
        </div>

        <a href="{{ route('admin.news.create') }}"
           class="dashboard-add-btn">
            + Add New News
        </a>
    </div>

    {{-- Dashboard statistics --}}
    @php
        $cards = [
            ['Total News', $totalNews, 'red'],
            ['Published', $publishedNews, 'green'],
            ['Drafts', $draftNews, 'orange'],
            ['Scheduled', $scheduledNews, 'blue'],
            ['Categories', $totalCategories, 'blue'],
            ['Subcategories', $totalSubcategories, 'blue'],
            ['Pinned News', $pinnedNews, 'red'],
        ];

        $dashboardNews = $latestNews->take(10);
    @endphp

    <div class="row g-3 mb-4">
        @foreach ($cards as [$label, $count, $color])
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card dashboard-stat {{ $color }}">
                    <div class="card-body">
                        <div class="dashboard-stat-label">
                            {{ $label }}
                        </div>

                        <div class="dashboard-stat-value">
                            {{ number_format($count) }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Latest 10 news --}}
    <section class="dashboard-news-panel">

        <div class="dashboard-news-header">
            <div>
                <h2>Recently Added News</h2>
                <p>Latest 10 news articles</p>
            </div>

            <a href="{{ route('admin.news.index') }}"
               class="dashboard-view-all">
                View All News &rarr;
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover dashboard-table">
                <thead>
                    <tr>
                        <th>News Heading</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Published At</th>
                        <th>Pinned</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($dashboardNews as $item)
                        @php
                            $status = strtolower($item->status ?? 'draft');

                            $statusColor = match ($status) {
                                'published' => 'success',
                                'draft' => 'warning',
                                'scheduled' => 'primary',
                                default => 'secondary',
                            };
                        @endphp

                        <tr>
                            <td>
                                <div class="dashboard-news-title">
                                    {{ $item->title }}
                                </div>
                            </td>

                            <td>
                                {{ $item->category_name ?? $item->category?->name ?? 'Unassigned' }}
                            </td>

                            <td>
                                <span class="badge text-bg-{{ $statusColor }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>

                            <td>
                                <span class="dashboard-date">
                                    {{ $item->published_at
                                        ? \Illuminate\Support\Carbon::parse($item->published_at)->format('d M Y, h:i A')
                                        : 'Not published' }}
                                </span>
                            </td>

                            <td>
                                @if ($item->is_pinned)
                                    <span class="badge text-bg-danger">Yes</span>
                                @else
                                    <span class="badge text-bg-secondary">No</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5"
                                class="text-center text-secondary py-5">
                                No news added yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="dashboard-footer">
            Showing {{ $dashboardNews->count() }} of
            {{ $totalNews }} total news articles.
        </div>

    </section>

</div>

@endsection