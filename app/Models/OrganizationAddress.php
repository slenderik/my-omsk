<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationAddress extends Model
{
    use HasFactory;


    /**
     * Атрибуты, которые ожно назначать при создании.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'organization_id',
        'address_title',
        'yandex_maps_link'
    ];


    // Определите обратную зависимость
    public function organization()
    {
        return $this->hasOne(Organization::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
