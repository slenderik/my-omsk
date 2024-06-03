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
        'organization_id',
        'organization_address',
    ];
    

    // Определите зависимость
    public function eventImage()
    {
        return $this->hasOne(EventImage::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function organizationAddress()
    {
        return $this->belongsTo(organizationAddress::class);
    }
}
