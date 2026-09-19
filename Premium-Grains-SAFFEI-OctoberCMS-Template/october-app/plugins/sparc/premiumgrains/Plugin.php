<?php namespace Sparc\PremiumGrains;

use Backend;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails(): array
    {
        return [
            'name' => 'Premium Grains Content',
            'description' => 'Editable content, projects, team profiles and enquiries for the Premium Grains website.',
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
                'description' => 'Manage the site identity, hero content, contact details, social links and locations.',
                'category' => 'Premium Grains',
                'icon' => 'icon-leaf',
                'class' => Models\Settings::class,
                'order' => 500,
                'keywords' => 'brand hero contact email social projects locations team',
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
                    'projects' => [
                        'label' => 'Projects',
                        'icon' => 'icon-folder-open',
                        'url' => Backend::url('sparc/premiumgrains/projects'),
                    ],
                    'projectpoints' => [
                        'label' => 'Project content',
                        'icon' => 'icon-list-alt',
                        'url' => Backend::url('sparc/premiumgrains/projectpoints'),
                    ],
                    'teammembers' => [
                        'label' => 'Team members',
                        'icon' => 'icon-users',
                        'url' => Backend::url('sparc/premiumgrains/teammembers'),
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
                    'farmhubs' => [
                        'label' => 'Farm hubs',
                        'icon' => 'icon-map-marker',
                        'url' => Backend::url('sparc/premiumgrains/farmhubs'),
                    ],
                    'partnerpoints' => [
                        'label' => 'Partner points',
                        'icon' => 'icon-briefcase',
                        'url' => Backend::url('sparc/premiumgrains/partnerpoints'),
                    ],
                    'contactmessages' => [
                        'label' => 'Contact messages',
                        'icon' => 'icon-envelope',
                        'url' => Backend::url('sparc/premiumgrains/contactmessages'),
                    ],
                ],
            ],
        ];
    }
}
