<?php namespace Sparc\PremiumGrains\Models;

use Model;

class TeamMember extends Model
{
    public $table = 'sparc_premiumgrains_team_members';

    protected $fillable = ['name', 'role', 'bio', 'image', 'is_active', 'sort_order'];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public $rules = [
        'name' => 'required',
        'role' => 'required',
    ];
}
