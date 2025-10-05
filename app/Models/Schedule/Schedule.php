<?php

namespace App\Models\Schedule;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory, SoftDeletes, Uuid;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'day',
        'date',
        'test_time',
        'quota',
        'participants',
        'room_id',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
