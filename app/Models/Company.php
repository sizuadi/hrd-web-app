<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status_id',
    ];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, "company_id");
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(CompanyStatus::class, "status_id");
    }
}
