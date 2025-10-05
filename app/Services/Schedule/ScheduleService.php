<?php

namespace App\Services\Schedule;

use App\Repositories\Contracts\Schedule\ScheduleInterface as ScheduleRepo;
use App\Services\Contracts\Schedule\ScheduleInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ScheduleService implements ScheduleInterface
{
    protected $scheduleRepo;

    public function __construct(ScheduleRepo $scheduleRepo)
    {
        $this->scheduleRepo = $scheduleRepo;
    }

    public function all()
    {
        return $this->scheduleRepo->all()->load('room');
    }

    public function getAllSimplePaginatedWithParams($params, $limit = 10)
    {
        return $this->scheduleRepo->getAllSimplePaginatedWithParams($params, $limit);
    }

    public function getAllPaginatedWithParams($params, $limit = 10)
    {
        return $this->scheduleRepo->getAllPaginatedWithParams($params, $limit);
    }

    /**
     * Find data by id
     *
     * @param $id
     * @param array $columns
     *
     * @return mixed
     */
    public function find($id)
    {
        return $this->scheduleRepo->find($id);
    }

    /**
     * @param $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function create($request)
    {
        $permission = DB::transaction(function () use ($request) {
           $input = $request->all();

           return $this->scheduleRepo->create([
               'day' => Carbon::parse($input['date'])->isoFormat('dddd'),
               'date' => $input['date'],
               'test_time' => $input['test_time'],
               'room_id' => $input['room_id'],
               'quota' => $input['quota'],
           ]);
        });

        return $permission;
    }


    /**
     * @param $id
     * @param $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function update($request, $id)
    {
        $permission = DB::transaction(function () use ($request, $id) {
            $input = $request->all();

            return $this->scheduleRepo->find($id)->update([
                'day' => Carbon::parse($input['date'])->isoFormat('dddd'),                'date' => $input['date'],
                'test_time' => $input['test_time'],
                'room_id' => $input['room_id'],
                'quota' => $input['quota'],
            ]);
        });

        return $permission;
    }

    /**
     * @param $id
     *
     * @return bool
     */
    public function delete($id)
    {
        return $this->scheduleRepo->delete($id);
    }
}
