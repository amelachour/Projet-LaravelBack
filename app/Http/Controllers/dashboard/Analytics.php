<?php

namespace App\Http\Controllers\dashboard;
use App\Models\Event;
use App\Models\Participation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class Analytics extends Controller
{
  public function index()
  {

    $totalEvents = Event::count();
    $totalParticipations = Participation::count();
    $participantsPerEvent = Event::withCount('participations')->get();
    $eventsByLocation = Event::select('location', DB::raw('count(*) as total'))
                             ->groupBy('location')
                             ->get();
    $data = [
        'totalEvents' => $totalEvents,
        'totalParticipations' => $totalParticipations,
        'participantsPerEvent' => $participantsPerEvent,
        'eventsByLocation' => $eventsByLocation,
    ];

    return view('content.dashboard.dashboards-analytics',compact('totalEvents', 'totalParticipations', 'participantsPerEvent', 'eventsByLocation'));
  }
}
