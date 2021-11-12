<?php

namespace App\Models;

use App\Traits\HasActivityTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attachment extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasActivityTrait;

    protected $table='attachments';

    protected $fillable=[
        'attachment_path',
        'attachmentable_id',
        'attachmentable_type',
    ];

    protected $appends = ['file_path'];

    public function getFilePathAttribute(): string
    {
        return $this->attachment_path
            ? asset('storage/'.$this->attachment_path)
            : $this->_defaultFilePath();
    }

    private function _defaultFilePath(): string
    {
        return asset('images/no-image-available.jpg');
    }

    /**
     * Get the owning attachmentable model.
     */
    public function attachmentable()
    {
        return $this->morphTo();
    }
}
