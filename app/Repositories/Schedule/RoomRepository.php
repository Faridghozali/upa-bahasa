<?php

namespace App\Repositories\Schedule;

use App\Models\Schedule\Room;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\Schedule\RoomInterface;

class RoomRepository extends BaseRepository implements RoomInterface
{
    /*
     * @var
     */
    protected $model;

    public function __construct(Room $room)
    {
        $this->model = $room;
    }

    public function all($columns = ['*'])
    {
        return $this->model->orderBy('created_at', 'ASC')->get($columns);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }
}
