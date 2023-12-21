<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArchiveIn extends Model
{
    use HasFactory;

    protected $fillable = [
        'archive_category_id',
        'date',
        'archive_number',
        'source',
        'subject',
        'archive_file',
        'description',
        'status_id',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ArchiveCategory::class, "archive_category_id");
    }
}
