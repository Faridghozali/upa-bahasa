<?php

namespace App\Services\Contracts\Schedule;

interface RoomInterface
{
    public function all();

    public function find($id);
}
