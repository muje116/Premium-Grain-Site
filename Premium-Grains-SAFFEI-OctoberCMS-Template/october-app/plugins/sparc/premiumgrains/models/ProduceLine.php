<?php namespace Sparc\PremiumGrains\Models;

use Model;

class ProduceLine extends Model
{
    public $table = 'sparc_premiumgrains_produce_lines';

    protected $fillable = ['name', 'descriptor', 'body', 'image', 'is_active', 'sort_order'];

    protected $casts = ['is_active' => 'boolean', 'sort_order' => 'integer'];

    public $rules = ['name' => 'required', 'body' => 'required'];
}
