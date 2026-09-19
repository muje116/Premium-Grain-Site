<?php namespace Sparc\PremiumGrains\Models;

use Model;

class Project extends Model
{
    public $table = 'sparc_premiumgrains_projects';

    protected $fillable = [
        'slug', 'name', 'kicker', 'title', 'summary', 'body', 'banner_image',
        'stat_label', 'stat_value', 'accent', 'is_featured', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public $rules = [
        'slug' => 'required|alpha_dash',
        'name' => 'required',
        'title' => 'required',
        'summary' => 'required',
    ];

    public $hasMany = [
        'points' => [ProjectPoint::class, 'key' => 'project_id'],
    ];
}
