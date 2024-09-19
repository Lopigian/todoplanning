<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'developer_id', 'week'];

    public function developer()
    {
        return $this->belongsTo(Developer::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

}
