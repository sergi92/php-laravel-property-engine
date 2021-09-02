<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'street',
        'number',
        'city',
        'province',
        'country',
        'status',
        'type',
        'description',
        'contact_email',
        'contact_phone',
        'condition',
        'room',
        'bath',
        'size',
        'price',
        'pet',
        'garden',
        'air_conditioning',
        'swimming_pool',
        'terrace'
    ];
}
