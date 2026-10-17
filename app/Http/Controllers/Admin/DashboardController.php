<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalNews = DB::table('news')->count();

        $publishedNews = DB::table('news')
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->count();

        $draftNews = DB::table('news')
            ->where('status', 'draft')
            ->count();

        $scheduledNews = DB::table('news')
            ->where('status', 'scheduled')
            ->count();

        $totalCategories = DB::table('categories')->count();

        $totalSubcategories = DB::table('subcategories')->count();

        $pinnedNews = DB::table('news')
            ->where('is_pinned', true)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->count();

        $latestNews = DB::table('news')
            ->leftJoin(
                'categories',
                'news.category_id',
                '=',
                'categories.id'
            )
            ->select(
                'news.id',
                'news.title',
                'news.status',
                'news.published_at',
                'news.is_pinned',
                'categories.name as category_name'
            )
            ->orderByDesc('news.created_at')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalNews',
            'publishedNews',
            'draftNews',
            'scheduledNews',
            'totalCategories',
            'totalSubcategories',
            'pinnedNews',
            'latestNews'
        ));
    }
}
