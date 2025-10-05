<?php

namespace App\Repositories\Schedule;

use App\Repositories\BaseRepository;
use App\Repositories\Contracts\Schedule\ScheduleInterface;
use App\Models\Schedule\Schedule;

class ScheduleRepository extends BaseRepository implements ScheduleInterface
{
    /*
     * @var
     */
    protected $model;

    public function __construct(Schedule $schedule)
    {
        $this->model = $schedule->whereNotNull('id');
    }

    public function all($columns = ['*'])
    {
        return $this->model->orderBy('created_at', 'ASC')->get($columns);
    }

    public function getAllSimplePaginatedWithParams($params, $limit = 10)
    {
        $schedule = $this->model;
        if (isset($params->search) && !empty($params->search)) $schedule->where('title', 'like', '%' . $params->search . '%');
        $schedule = $schedule->with(['room'])->orderBy('created_at', 'ASC')->simplePaginate($limit);
        return $schedule;
    }

    public function getAllPaginatedWithParams($params, $limit = 10)
    {
        $schedule = $this->model;
//        if (isset($params->search) && !empty($params->search)) $schedule->where('title', 'like', '%' . $params->search . '%');
        $schedule = $schedule->with(['room'])->orderBy('created_at', 'ASC')->simplePaginate($limit);
        return $schedule;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }
}
