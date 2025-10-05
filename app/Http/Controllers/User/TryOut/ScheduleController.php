<?php

namespace App\Http\Controllers\User\TryOut;

use App\Http\Controllers\Controller;
use App\Models\Schedule\Schedule;
use App\Services\Schedule\ScheduleService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    protected $scheduleService;

    public function __construct(ScheduleService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return inertia('User/TryOut/Schedule/Index', [
            'schedules' => Schedule::with('room')
                ->where('date', '>=', Carbon::now()) // pakai presisi sampai jam-menit
                ->orderBy('date', 'ASC')
                ->limit(5)
                ->get()
        ]);
    }
}
