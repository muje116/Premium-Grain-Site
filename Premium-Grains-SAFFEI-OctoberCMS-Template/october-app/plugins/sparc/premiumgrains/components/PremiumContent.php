<?php namespace Sparc\PremiumGrains\Components;

use Cms\Classes\ComponentBase;
use Sparc\PremiumGrains\Models\FarmHub;
use Sparc\PremiumGrains\Models\JourneyStep;
use Sparc\PremiumGrains\Models\ModelStep;
use Sparc\PremiumGrains\Models\Page;
use Sparc\PremiumGrains\Models\PartnerPoint;
use Sparc\PremiumGrains\Models\Principle;
use Sparc\PremiumGrains\Models\SaffeiFocus;
use Sparc\PremiumGrains\Models\Settings;

class PremiumContent extends ComponentBase
{
    public function componentDetails(): array
    {
        return [
            'name' => 'Premium Grains content',
            'description' => 'Loads editable Premium Grains and SAFFEI content for a page.',
        ];
    }

    public function defineProperties(): array
    {
        return [
            'pageCode' => [
                'title' => 'Page code',
                'description' => 'The content record to use for the current page.',
                'type' => 'string',
                'default' => 'home',
            ],
        ];
    }

    public function onRun(): void
    {
        $pages = Page::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->keyBy('code');

        $this->page['site'] = Settings::instance();
        $this->page['pages'] = $pages;
        $this->page['pageContent'] = $pages->get($this->property('pageCode'));
        $this->page['principles'] = Principle::where('is_active', true)->orderBy('sort_order')->get();
        $this->page['modelSteps'] = ModelStep::where('is_active', true)->orderBy('sort_order')->get();
        $this->page['saffeiFocus'] = SaffeiFocus::where('is_active', true)->orderBy('sort_order')->get();
        $this->page['farmHubs'] = FarmHub::where('is_active', true)->orderBy('sort_order')->get();
        $this->page['journeySteps'] = JourneyStep::where('is_active', true)->orderBy('sort_order')->get();
        $this->page['partnerPoints'] = PartnerPoint::where('is_active', true)->orderBy('sort_order')->get();
    }
}
