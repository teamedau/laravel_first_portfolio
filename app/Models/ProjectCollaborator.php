<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectCollaborator extends Model
{
    protected $fillable = ['project_id', 'name', 'role', 'url'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
