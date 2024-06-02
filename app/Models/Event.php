<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;


    /**
     * Атрибуты, которые ожно назначать при создании.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'english_name',
        'title',
        'description',
        'background_colour',
        'organization',
        'organization_address',
    ];
    

    // Определите зависимость
    public function eventImage()
    {
        return $this->hasOne(EventImage::class);
    }

    public function organization()
    {
        return $this->hasOne(Organization::class);
    }

    public function organizationAddress()
    {
        return $this->hasOne(organizationAddress::class);
    }
}
