<?php
namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
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
        $equipmentWithMaintenanceCount = Equipment::with('maintenances')->count();
        // Équipements sans maintenance
        $equipmentWithoutMaintenanceCount = Equipment::doesntHave('maintenances')->count();

        // Équipements par mois
        $monthlyEquipmentCounts = Equipment::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count');

        $months = Equipment::selectRaw('MONTHNAME(created_at) as month_name')
            ->groupBy('month_name')
            ->orderByRaw('MONTH(created_at)')
            ->pluck('month_name');

        return view('content.dashboard.dashboards-analytics', compact(
            'categoryNames', 'centerCounts', 'totalCenters', 'totalCategories',
            'topCategory', 'totalWasteWeight', 'totalDisposalRecords',
            'commonDisposalMethod', 'monthlyEquipmentCounts', 'months', 
            'equipmentWithMaintenanceCount', 'equipmentWithoutMaintenanceCount'
        ));
    }
}
