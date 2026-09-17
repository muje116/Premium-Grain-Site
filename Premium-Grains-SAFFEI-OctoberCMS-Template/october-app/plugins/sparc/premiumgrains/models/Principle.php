<?php namespace Sparc\PremiumGrains\Models;

use Model;

class Principle extends Model
{
    public $table = 'sparc_premiumgrains_principles';

    protected $fillable = ['number', 'title', 'body', 'is_active', 'sort_order'];

    protected $casts = ['number' => 'integer', 'is_active' => 'boolean', 'sort_order' => 'integer'];

    public $rules = ['title' => 'required', 'body' => 'required'];
}
