<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Station extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'longitude',
        'latitude',
        'company_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'company_id' => 'integer',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
