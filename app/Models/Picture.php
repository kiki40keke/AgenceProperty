<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Picture extends Model
{
    protected $fillable = [
        'filename',
    ];

    protected static function booted(): void
    {
        static::deleting(function (Picture $picture) {
            Storage::disk('public')->delete($picture->filename);
            // ...
        });
    }

    public function getPicturesUrl() : string
    {
        return Storage::disk('public')->url($this->filename);
    }

}
