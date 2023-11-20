<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'name',
        'description',
        'start_date',
        'end_date',
        'status_id',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, "company_id");
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(ProjectStatus::class, "status_id");
    }
}
