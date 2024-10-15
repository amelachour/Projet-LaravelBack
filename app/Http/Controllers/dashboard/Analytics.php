<?php
namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\RecyclingCenter;

class Analytics extends Controller
{
    public function index()
    {
        //Centre selon Catégorie !! 
        $categories = Category::withCount('recyclingCenters')->get();
        $categoryNames = $categories->pluck('name');
        $centerCounts = $categories->pluck('recycling_centers_count');
        $totalCenters = RecyclingCenter::count(); 
        $totalCategories = Category::count();     
        $topCategory = $categories->sortByDesc('recycling_centers_count')->first()->name; 

        
        // Passez les variables à la vue
        return view('content.dashboard.dashboards-analytics', compact('categoryNames', 'centerCounts', 'totalCenters', 'totalCategories', 'topCategory'));
    }
}
