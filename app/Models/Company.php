<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'logo',
        'website',
    ];

    protected $appends = [
        'logoPath'
    ];

    public function getLogoPathAttribute()
    {
        return $this->logo
            ? asset( 'storage/' . $this->logo)
            : asset('images/no-image.png');
    }
}
