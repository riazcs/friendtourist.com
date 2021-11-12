<?php

namespace App\Models;

use App\Traits\HasActivityTrait;
use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavouriteArea extends Model
{
    use HasFactory;
    use HasAttachmentTrait;
    use HasActivityTrait;
    protected $table = 'favourite_areas';
    protected $fillable = [
        'area_name',
        'status'
        ];
}
