<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'project_id',
        'user_id',
        'start_date',
        'end_date',
        'status_id',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, "company_id");
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, "project_id");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(UserProject::class, "status_id");
    }
}
