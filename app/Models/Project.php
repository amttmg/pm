<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function descriptions()
    {
        return $this->hasMany(ProjectDetail::class);
    }

    public function files()
    {
        return $this->morphMany(File::class, 'filable');
    }
}
