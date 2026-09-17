<?php namespace Sparc\PremiumGrains\Models;

use Model;

class FarmHub extends Model
{
    public $table = 'sparc_premiumgrains_farm_hubs';

    protected $fillable = ['name', 'location', 'metric_label', 'metric_value', 'descriptor', 'points', 'accent', 'is_active', 'sort_order'];

    protected $casts = ['is_active' => 'boolean', 'sort_order' => 'integer'];

    public $rules = ['name' => 'required', 'location' => 'required', 'points' => 'required'];

    public function getPointsListAttribute(): array
    {
        return preg_split('/\r\n|\r|\n/', trim((string) $this->points), -1, PREG_SPLIT_NO_EMPTY);
    }
}
