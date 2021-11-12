<?php

namespace App\Models;

use App\Traits\HasActivityTrait;
use App\Traits\HasAttachmentTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    use HasActivityTrait;
    use HasAttachmentTrait;
    protected $table = 'blogs';
    protected $fillable = [
        'title',
        'description',
        'type',
        'status',
    ];
}
