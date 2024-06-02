<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventImage extends Model
{
    use HasFactory;


    /**
     * Атрибуты, которые ожно назначать при создании.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'event_id',
        'image_name',
        'image_alt'
    ];

    /**
     * Указывает, должна ли модель иметь метку времени (timestamps).
     *
     * @var bool
     */
    public $timestamps = false;

    
    // Определите обратную зависимость
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
