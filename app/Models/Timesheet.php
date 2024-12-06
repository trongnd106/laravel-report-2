<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Timesheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'work_date',
        'check_in',
        'check_out',
        'hours_worked',
    ];

    /**
     * Relationship w User (Many-to-One)
     */
    public function user()
    {
        return $this->belongsTo(User::class);  
    }
}
