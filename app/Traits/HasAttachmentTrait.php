<?php

namespace App\Traits;

use App\Models\Attachment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

trait HasAttachmentTrait
{
    /**
     * Morph Many relation with Attachment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function attachment()
    {
        return $this->morphOne(Attachment::class, 'attachmentable')
            ->withDefault([
                'id'=>null,
                'file_path'=>$this->_defaultFilePath()
            ]);
    }


    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }

    protected static function bootHasAttachmentTrait()
    {
        self::deleting(function ($model) {
            Storage::disk(config('filesystems.default'))->delete($model->attachment->url);
            $model->attachment()->delete();
        });
    }

    public function uploadAttachment(UploadedFile $photo)
    {
        $url= $photo->storePublicly(
            $this->table, ['disk' => config('filesystems.default')]
        );
        tap($this->attachment, function ($previous) use ($url) {
            try {
                $this->attachment()->create([
                    'attachment_path'=>$url
                ]);

                if ($previous) {
                    $previous->delete();
                }
            }catch (\Exception $exception){
                $this->attachment()->delete();
            }
        });
    }

    public function uploadAttachmentWithoutPrevDelete(UploadedFile $photo)
    {
        $url= $photo->storePublicly(
            $this->table, ['disk' => config('filesystems.default')]
        );
        tap($this->attachment, function () use ($url) {
            try {
                $this->attachment()->create([
                    'attachment_path'=>$url
                ]);
            }catch (\Exception $exception){
                $this->attachment()->delete();
            }
        });
    }

    private function _defaultFilePath(){
        return asset('images/no-image-available.jpg');
    }
}
