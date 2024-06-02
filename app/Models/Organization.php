<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;


    /**
     * Атрибуты, которые ожно назначать при создании.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
    ];
    

    // Определите зависимость
    public function organizationAddress()
    {
        return $this->hasOne(OrganizationAddress::class);
    }
}
