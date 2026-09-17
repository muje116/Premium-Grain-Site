<?php namespace Sparc\PremiumGrains\Models;

use Model;

class Page extends Model
{
    public $table = 'sparc_premiumgrains_pages';

    protected $fillable = [
        'code', 'label', 'kicker', 'title', 'intro', 'meta_title', 'meta_description', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public $rules = [
        'code' => 'required|alpha_dash',
        'label' => 'required',
        'title' => 'required',
    ];
}
