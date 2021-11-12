<?php

namespace App\Models;

use App\Traits\HasActivityTrait;
use App\Traits\HasFilterTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasActivityTrait;
    use HasFilterTrait;

    const TYPES = [
        'Fixed'=>1,
        'Percent'=>2
    ];


    protected $table = 'coupons';
    protected $fillable = [
        'host_id',
        'coupon_code',
        'coupon_value',
        'max_limit',
        'discount_type',
        'minimum_order_value',
        'status',
        'start_date',
        'end_date',
    ];

    protected $appends=['discount_label'];

    public function getDiscountLabelAttribute()
    {
        $types = array_flip(self::TYPES);

        return $types[$this->attributes['discount_type']];
    }

    public function getStartDateAttribute()
    {
        return Carbon::parse($this->attributes['start_date'])->format('d-m-Y');
    }

    public function getEndDateAttribute()
    {
        return Carbon::parse($this->attributes['end_date'])->format('d-m-Y');
    }
}
