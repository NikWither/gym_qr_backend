<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Simulator extends Model
{
    protected $table = 'simulators';

    protected $fillable = ['title', 'slug', 'img_path'];

    public function qrCode(): HasOne
    {
        return $this->hasOne(QrCode::class, 'simulator_id', 'id');
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        // генерируем slug из title
        $slug = \Illuminate\Support\Str::slug($value);
        $this->attributes['slug'] = $this->refactorSlugAttribute($slug);
    }

    public function refactorSlugAttribute($value)
    {
        return strtolower($value);
    }
}
