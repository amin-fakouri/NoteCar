<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specifications extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $casts = [
        'price_car' => 'integer',
        'mileage' => 'integer',
        'images' => 'array',
    ];


    protected $fillable = [
        'submitted_by',
        'identification_number',
        'plat_number',
        'model',
        'color',
        'car_name',
        'car_fuel_type',
        'promise_number',
        //        'profit',
        //        'loss',
        'seller',
        'mobile_seller',
        'buyer',
        'mobile_buyer',
        'cylinder_type',
        'gear_type',
        'description',
        'price_car',
        'gearbox_type',
        'created_post',
        'situation_mode',
        'edited_by',
        'mileage',
        'deleted_by',
        'images',
    ];

    public function submitter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
