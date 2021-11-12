<?php

namespace App\Models;

use App\Traits\HasActivityTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasActivityTrait;
    protected $table = 'faqs';
    protected $fillable = [
        'faqable_type',
        'faqable_id',
        'question',
        'answer',
        'status',
    ];

    public function faqable()
    {
        return $this->morphTo();
    }
}
