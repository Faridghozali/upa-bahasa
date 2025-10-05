<?php

namespace App\Services\Contracts\Schedule;

interface ScheduleInterface
{
    public function find($id);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);
}
