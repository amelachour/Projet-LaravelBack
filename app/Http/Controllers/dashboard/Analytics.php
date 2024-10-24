<?php
namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\RecyclingCenter;
use App\Models\Waste;
use App\Models\DisposalRecord;
use App\Models\Equipment;

class Analytics extends Controller
{
  public function index()
  {
    // Centre selon Catégorie
    $categories = Category::withCount('recyclingCenters')->get();
    $categoryNames = $categories->pluck('name');
    $centerCounts = $categories->pluck('recycling_centers_count');
    $totalCenters = RecyclingCenter::count();
    $totalCategories = Category::count();
    $topCategory = $categories->sortByDesc('recycling_centers_count')->first()->name;

    // Waste and Disposal statistics
    $totalWasteWeight = Waste::sum('weight');
    $totalDisposalRecords = DisposalRecord::count();
    $commonDisposalMethod = DisposalRecord::select('method')
      ->groupBy('method')
      ->orderByRaw('COUNT(*) DESC')
      ->limit(1)
      ->pluck('method')
      ->first();

    // Équipements avec Maintenance
    $equipmentWithMaintenanceCount = Equipment::whereHas('maintenances')->count();
    // Équipements sans maintenance
    $equipmentWithoutMaintenanceCount = Equipment::doesntHave('maintenances')->count();

    // Équipements par mois
    $monthlyEquipmentCounts = Equipment::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
      ->groupBy('month')
      ->orderBy('month')
      ->pluck('count');

    $months = Equipment::selectRaw('MONTHNAME(created_at) as month_name, MONTH(created_at) as month_number')
      ->groupBy('month_number', 'month_name')
      ->orderBy('month_number')
      ->pluck('month_name');

    // Posts, Likes, and Comments Statistics
    $totalPosts = Post::count();
    $totalLikes = Like::count();
    $totalComments = Comment::count();
    $mostLikedPost = Post::withCount('likes')->orderBy('likes_count', 'desc')->first();

    return view('content.dashboard.dashboards-analytics', compact(
      'categoryNames', 'centerCounts', 'totalCenters', 'totalCategories',
      'topCategory', 'totalWasteWeight', 'totalDisposalRecords',
      'commonDisposalMethod', 'monthlyEquipmentCounts', 'months',
      'equipmentWithMaintenanceCount', 'equipmentWithoutMaintenanceCount',
      'totalPosts', 'totalLikes', 'totalComments', 'mostLikedPost'
    ));
  }}
