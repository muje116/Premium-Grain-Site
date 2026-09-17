<?php namespace Sparc\PremiumGrains\Models;

use Model;

class PartnerPoint extends Model
{
    public $table = 'sparc_premiumgrains_partner_points';

    protected $fillable = ['number', 'title', 'body', 'is_active', 'sort_order'];

    protected $casts = ['number' => 'integer', 'is_active' => 'boolean', 'sort_order' => 'integer'];

    public $rules = ['title' => 'required', 'body' => 'required'];
}
