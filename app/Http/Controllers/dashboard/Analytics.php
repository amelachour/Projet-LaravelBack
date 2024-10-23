<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
use App\Models\Participation;
use App\Models\Category;
use App\Models\RecyclingCenter;
use App\Models\Waste;
use App\Models\DisposalRecord;
use App\Models\Equipment;

class Analytics extends Controller
{
    public function index()
    {

        // *** Statistiques sur les événements ***
        $totalEvents = Event::count();
        $totalParticipations = Participation::count();
        $participantsPerEvent = Event::withCount('participations')->get();
        $eventsByLocation = Event::select('location', DB::raw('count(*) as total'))
                                 ->groupBy('location')
                                 ->get();
    
        // *** Centres de recyclage par catégorie ***

        $categories = Category::withCount('recyclingCenters')->get();
        $categoryNames = $categories->pluck('name');
        $centerCounts = $categories->pluck('recycling_centers_count');
        $totalCenters = RecyclingCenter::count();
        $totalCategories = Category::count();

        $topCategoryName = optional($categories->sortByDesc('recycling_centers_count')->first())->name ?? 'N/A';
    
        // *** Statistiques sur les déchets et enregistrements de disposition ***

        $totalWasteWeight = Waste::sum('weight');
        $totalDisposalRecords = DisposalRecord::count();
        $commonDisposalMethod = DisposalRecord::select('method')
            ->groupBy('method')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(1)
            ->pluck('method')
            ->first();

    
        // *** Équipements et maintenance ***
        $equipmentWithMaintenanceCount = Equipment::with('maintenances')->count();
        $equipmentWithoutMaintenanceCount = Equipment::doesntHave('maintenances')->count();
    
        // *** Équipements par mois ***

        $monthlyEquipmentCounts = Equipment::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count');

    
        $months = Equipment::selectRaw('MONTHNAME(created_at) as month_name')
            ->groupBy('month_name')
            ->orderBy('month_name')
            ->pluck('month_name');
    
        // Transmettre les données à la vue
        return view('content.dashboard.dashboards-analytics', [
            'totalParticipations' => $totalParticipations,
            'participantsPerEvent' => $participantsPerEvent,
            'eventsByLocation' => $eventsByLocation,
            'categoryNames' => $categoryNames,
            'centerCounts' => $centerCounts,
            'totalCenters' => $totalCenters,
            'totalCategories' => $totalCategories,
            'topCategory' => $topCategoryName,
            'totalWasteWeight' => $totalWasteWeight,
            'totalDisposalRecords' => $totalDisposalRecords,
            'commonDisposalMethod' => $commonDisposalMethod,
            'equipmentWithMaintenanceCount' => $equipmentWithMaintenanceCount,
            'equipmentWithoutMaintenanceCount' => $equipmentWithoutMaintenanceCount,
            'monthlyEquipmentCounts' => $monthlyEquipmentCounts,
            'months' => $months
        ]);
    }
}    