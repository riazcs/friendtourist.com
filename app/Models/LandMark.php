<?php

namespace App\Models;

use App\Traits\HasActivityTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LandMark extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasActivityTrait;
    const Type = [
      'Landmark' => 1,
      'Terminal' => 2
    ];
    protected $table='land_marks';

    protected $fillable=[
        'hotel_id',
        'type',
        'distance',
        'name'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id', 'id');
    }
}
