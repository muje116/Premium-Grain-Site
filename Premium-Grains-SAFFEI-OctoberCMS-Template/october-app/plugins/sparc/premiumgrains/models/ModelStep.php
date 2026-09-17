<?php namespace Sparc\PremiumGrains\Models;

use Model;

class ModelStep extends Model
{
    public $table = 'sparc_premiumgrains_model_steps';

    protected $fillable = ['number', 'short_code', 'title', 'body', 'is_active', 'sort_order'];

    protected $casts = ['number' => 'integer', 'is_active' => 'boolean', 'sort_order' => 'integer'];

    public $rules = ['title' => 'required', 'body' => 'required'];
}
