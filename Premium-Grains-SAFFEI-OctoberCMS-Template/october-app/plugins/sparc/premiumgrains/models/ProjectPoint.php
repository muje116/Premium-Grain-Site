<?php namespace Sparc\PremiumGrains\Models;

use Model;

class ProjectPoint extends Model
{
    public $table = 'sparc_premiumgrains_project_points';

    protected $fillable = [
        'project_id', 'category', 'number', 'title', 'body', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'project_id' => 'integer',
        'number' => 'integer',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public $rules = [
        'project' => 'required',
        'title' => 'required',
        'body' => 'required',
    ];

    public $belongsTo = [
        'project' => [Project::class, 'key' => 'project_id'],
    ];
}
