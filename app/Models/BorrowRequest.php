<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'catalog_item_id',
        'student_name',
        'student_email',
        'requested_at',
        'due_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'requested_at' => 'date',
        'due_date' => 'date',
    ];

    public function catalogItem()
    {
        return $this->belongsTo(CatalogItem::class);
    }
}
