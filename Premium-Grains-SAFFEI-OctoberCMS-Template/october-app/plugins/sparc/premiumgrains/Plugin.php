<?php namespace Sparc\PremiumGrains;

use Backend;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails(): array
    {
        return [
            'name' => 'Premium Grains Content',
            'description' => 'Editable content and presentation data for the Premium Grains x SAFFEI website.',
            'author' => 'Sparc Systems Limited',
            'icon' => 'icon-leaf',
        ];
    }

    public function registerComponents(): array
    {
        return [
            Components\PremiumContent::class => 'premiumContent',
        ];
    }

    public function registerSettings(): array
    {
        return [
            'brand' => [
                'label' => 'Premium Grains',
                'description' => 'Manage the site identity, hero content, contact details and locations.',
                'category' => 'Premium Grains',
                'icon' => 'icon-leaf',
                'class' => Models\Settings::class,
                'order' => 500,
                'keywords' => 'brand hero contact email locations saffei',
                'permissions' => ['sparc.premiumgrains.manage_content'],
            ],
        ];
    }

    public function registerPermissions(): array
    {
        return [
            'sparc.premiumgrains.manage_content' => [
                'tab' => 'Premium Grains',
                'label' => 'Manage Premium Grains content',
            ],
        ];
    }

    public function registerNavigation(): array
    {
        return [
            'premiumgrains' => [
                'label' => 'Premium Grains',
                'url' => Backend::url('sparc/premiumgrains/pages'),
                'icon' => 'icon-leaf',
                'permissions' => ['sparc.premiumgrains.manage_content'],
                'order' => 500,
                'sideMenu' => [
                    'pages' => [
                        'label' => 'Pages',
                        'icon' => 'icon-file-text',
                        'url' => Backend::url('sparc/premiumgrains/pages'),
                    ],
                    'principles' => [
                        'label' => 'Vision, mission & values',
                        'icon' => 'icon-star',
                        'url' => Backend::url('sparc/premiumgrains/principles'),
                    ],
                    'modelsteps' => [
                        'label' => 'Agribusiness model',
                        'icon' => 'icon-refresh',
                        'url' => Backend::url('sparc/premiumgrains/modelsteps'),
                    ],
                    'saffeifocus' => [
                        'label' => 'SAFFEI focus areas',
                        'icon' => 'icon-heart',
                        'url' => Backend::url('sparc/premiumgrains/saffeifocus'),
                    ],
                    'farmhubs' => [
                        'label' => 'Farm hubs',
                        'icon' => 'icon-map-marker',
                        'url' => Backend::url('sparc/premiumgrains/farmhubs'),
                    ],
                    'journeysteps' => [
                        'label' => 'SAFFEI journey',
                        'icon' => 'icon-list-ol',
                        'url' => Backend::url('sparc/premiumgrains/journeysteps'),
                    ],
                    'partnerpoints' => [
                        'label' => 'Partner points',
                        'icon' => 'icon-briefcase',
                        'url' => Backend::url('sparc/premiumgrains/partnerpoints'),
                    ],
                ],
            ],
        ];
    }
}
