<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimeSlot extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = "time_slots";
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'shift_id',
        'start_time',
        'end_time',
    ];
    public function shift()
    {
        return $this->belongsTo('App\Model\Shift', 'shift_id');
    }
}
