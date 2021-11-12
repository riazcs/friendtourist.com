<?php

namespace App\Models;

use App\Traits\HasFilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    use HasFilterTrait;

    protected $guarded = ['id'];

    public function scopeSearchBy($query, $request)
    {
        return $query->where('name', 'LIKE', '%'.$request->search_key.'%');
    }

    public function hotels()
    {
        return $this->hasMany(Hotel::class, 'district_id', 'id');
    }
    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }
}
