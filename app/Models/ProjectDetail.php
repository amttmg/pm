<?php

namespace App\Models;

use Illuminate\Container\Attributes\Auth;
use Illuminate\Database\Eloquent\Model;

class ProjectDetail extends Model
{
    protected $fillable = ['title', 'description'];

    public function files()
    {
        return $this->morphMany(File::class, 'filable');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = auth()->user()->id;
        });
    }
}
