<?php

namespace App\Models;

use App\Traits\HasActivityTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasActivityTrait;

    const Convenience_percent = 0.025;
    const Currency = 'BDT';
    const Method = 'SSL';

    const PaymentStatus = [
        'Complete'=>1,
        'Fail'=>2,
        'Pending'=>3,
        'Canceled'=>4
    ];

    const Status = [
        'Complete'=>1,
        'Pending'=>2,
        'Canceled'=>3,
        'CheckIn'=>4,
        'CheckOut'=>5
    ];


    protected $table='bookings';

    protected $fillable=[
        'invoice_no',
        'user_id',
        'hotel_id',
        'total_room',
        'adult',
        'child',
        'check_in',
        'check_out',
        'rack_total',
        'hotel_discount', //percent value
        'sub_total',
        'total_charge',
        'coupon_id',
        'coupon_discount',
        'convenience_fee',
        'total_amount',
        'total_save',
        'transaction_id',
        'currency',
        'status',
        'payment_status',
        'payment_method',
        'contact_name',
        'contact_phone',
        'contact_email',
        'contact_address',
    ];

    protected $appends=[
        'check_in_date',
        'check_out_date',
        'status_label',
        'payment_label',
        'nights'
    ];

    public function getCheckInDateAttribute()
    {
        return Carbon::parse($this->attributes['check_in'])->format('d, M y');
    }

    public function getCheckOutDateAttribute()
    {
        return Carbon::parse($this->attributes['check_out'])->format('d, M y');
    }

    public function getNightsAttribute()
    {
        return Carbon::parse($this->attributes['check_out'])->diffInDays(Carbon::parse($this->attributes['check_in']));
    }

    public function getStatusLabelAttribute()
    {
        $status = array_flip(self::Status);
        return $status[$this->attributes['status']];
    }

    public function getPaymentLabelAttribute()
    {
        $status = array_flip(self::PaymentStatus);
        return $status[$this->attributes['payment_status']];
    }

    public function scopeSearchBy($query, $request)
    {

        if(!empty($request->range)){
            if(!empty($request->range->start)){
                $query = $query->whereDate('check_in', Carbon::parse($request->range->start)->format('Y-m-d'));
            }

            if(!empty($request->range->end)){
                $query = $query->whereDate('check_in', Carbon::parse($request->range->end)->format('Y-m-d'));
            }
        }
        return $query;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id', 'id');
    }

    public function booked_rooms()
    {
        return $this->hasMany(BookedRoom::class, 'booking_id', 'id');
    }

    public function guests()
    {
        return $this->hasMany(Guest::class, 'booking_id', 'id');
    }

    public function rating()
    {
        return $this->hasOne(Rating::class, 'booking_id', 'id');
    }

    public static function generate_random_id($length = 10)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function ssl_commerz_post_array($total, $tran_id, $hotel_name)
    {
        $paymentData = array();
        $paymentData['total_amount'] = $total; # You cant not pay less than 10
        $paymentData['currency'] = self::Currency;
        $paymentData['tran_id'] = $tran_id; // tran_id must be unique
        # CUSTOMER INFORMATION
        $paymentData['cus_name'] = auth()->user()->name;
        $paymentData['cus_email'] = auth()->user()->email;
        $paymentData['cus_add1'] = "Dhaka";
        $paymentData['cus_add2'] = "";
        $paymentData['cus_city'] = "Dhaka";
        $paymentData['cus_state'] = "Dhaka";
        $paymentData['cus_postcode'] = "1000";
        $paymentData['cus_country'] = "Bangladesh";
        $paymentData['cus_phone'] = auth()->user()->phone;
        $paymentData['cus_fax'] = "";

        $paymentData['ship_name'] = config('app.name');
        $paymentData['ship_add1'] = "Dhaka";
        $paymentData['ship_add2'] = "Dhaka";
        $paymentData['ship_city'] = "Dhaka";
        $paymentData['ship_state'] = "Dhaka";
        $paymentData['ship_postcode'] = "1207";
        $paymentData['ship_phone'] = "";
        $paymentData['ship_country'] = "Bangladesh";


        $paymentData['shipping_method'] = "NO";
        $paymentData['product_name'] = $hotel_name;
        $paymentData['product_category'] = "Service";
        $paymentData['product_profile'] = "service";

        return $paymentData;
    }
}
