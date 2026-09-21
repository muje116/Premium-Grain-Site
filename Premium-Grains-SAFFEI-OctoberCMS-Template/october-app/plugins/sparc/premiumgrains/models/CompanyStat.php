<?php namespace Sparc\PremiumGrains\Models;

use Model;

class CompanyStat extends Model
{
    public $table = 'sparc_premiumgrains_company_stats';

    protected $fillable = ['slug', 'value', 'label', 'context', 'is_active', 'sort_order'];

    protected $casts = ['is_active' => 'boolean', 'sort_order' => 'integer'];

    public $rules = ['slug' => 'required|alpha_dash', 'value' => 'required', 'label' => 'required'];
}
