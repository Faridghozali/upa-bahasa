<?php

namespace App\Services\Schedule;

use App\Repositories\Schedule\RoomRepository;
use App\Services\Contracts\Schedule\RoomInterface;

class RoomService implements RoomInterface
{
    protected $roomRepo;

    public function __construct(RoomRepository $roomRepo)
    {
        $this->roomRepo = $roomRepo;
    }

    /**
     * Get all data
     *
     * @param array $columns
     *
     * @return mixed
     */
    public function all($columns = ['*'])
    {
        return $this->roomRepo->all($columns);
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
        return $this->roomRepo->find($id);
    }
}
