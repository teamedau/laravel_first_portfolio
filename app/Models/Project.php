<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'tagline',
        'description',
        'image',
        'tech',
        'link',
        'status',
        'progress',
        'category',
        'launch_date',
        'featured',
    ];

    protected $casts = [
        'status'      => ProjectStatus::class,
        'launch_date' => 'date',
        'featured'    => 'boolean',
        'votes'       => 'integer',
        'progress'    => 'integer',
    ];

    public function followers()
    {
        return $this->hasMany(ProjectFollower::class);
    }

    public function updates()
    {
        return $this->hasMany(ProjectUpdate::class)->latest();
    }

    public function collaborators()
    {
        return $this->hasMany(ProjectCollaborator::class);
    }

    public function isFollowedBy(?User $user): bool
    {
        if (!$user) return false;
        return $this->followers()->where('user_id', $user->id)->exists();
    }

    public function followRoleFor(?User $user): ?string
    {
        if (!$user) return null;
        return $this->followers()->where('user_id', $user->id)->value('role');
    }

    public function hasVotedBy(?User $user): bool
    {
        if (!$user) return false;
        return DB::table('project_votes')
            ->where('user_id', $user->id)
            ->where('project_id', $this->id)
            ->exists();
    }

    public function getTechArrayAttribute(): array
    {
        if (!$this->tech) return [];
        return array_filter(array_map('trim', explode(',', $this->tech)));
    }

    public function getFollowersCountAttribute(): int
    {
        return $this->followers()->where('role', 'follower')->count();
    }

    public function getTestersCountAttribute(): int
    {
        return $this->followers()->where('role', 'tester')->count();
    }
}
