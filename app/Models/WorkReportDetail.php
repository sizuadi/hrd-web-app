<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkReportDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_report_id',
        'work_type_id',
        'module',
        'day',
        'hour',
        'total_hour',
    ];

    public function work_report(): BelongsTo
    {
        return $this->belongsTo(WorkReport::class, "work_report_id");
    }
}
