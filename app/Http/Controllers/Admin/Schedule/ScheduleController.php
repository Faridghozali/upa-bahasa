<?php

namespace App\Http\Controllers\Admin\Schedule;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;
use App\Services\Schedule\RoomService;
use App\Services\Schedule\ScheduleService;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    protected $scheduleService;
    protected $roomService;

    public function  __construct(ScheduleService $scheduleService, RoomService $roomService)
    {
        $this->scheduleService = $scheduleService;
        $this->roomService = $roomService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return inertia('Admin/Schedule/Index', [
            'schedules' => $this->scheduleService->getAllPaginatedWithParams($request)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia('Admin/Schedule/Create', [
            'rooms' => $this->roomService->all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ScheduleRequest $request)
    {
        try {
          $this->scheduleService->create($request);

          return redirect()->route('admin.schedules.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
            #get message
            session()->flash('failed', $e->getMessage() . ' in file :'.$e->getFile() .' line: '. $e->getLine());

            #redirect
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $schedule = $this->scheduleService->find($id);

        if (! $schedule) {
            abort(404, 'Uppss....');
        }

        return inertia('Admin/Schedule/Edit', [
            'schedule' => $schedule,
            'rooms'    => $this->roomService->all(),
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ScheduleRequest $request, string $id)
    {
        try {
            if(!$this->scheduleService->find($id)) return abort('404', 'uppss....');

            #update
            $this->scheduleService->update($request, $id);

            #Bump....
            return redirect()->route('admin.schedules.index');
        } catch(\Exception $e) {
            #get message
            session()->flash('failed', $e->getMessage() . ' in file :'.$e->getFile() .' line: '. $e->getLine());

            #redirect
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            #delete
            $this->scheduleService->delete($id);

            #Bump....
            return redirect()->route('admin.schedules.index');

        } catch(\Exception $e) {
            #get message
            session()->flash('failed', $e->getMessage() . ' in file :'.$e->getFile() .' line: '. $e->getLine());

            #redirect
            return redirect()->back()->withInput($request->all());
        }
    }
}
