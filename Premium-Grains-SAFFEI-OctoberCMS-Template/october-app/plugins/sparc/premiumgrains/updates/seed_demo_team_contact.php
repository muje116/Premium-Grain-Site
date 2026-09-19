<?php namespace Sparc\PremiumGrains\Updates;

use DB;
use October\Rain\Database\Updates\Migration;
use Sparc\PremiumGrains\Models\Settings;

class SeedDemoTeamContact extends Migration
{
    public function up(): void
    {
        $now = date('Y-m-d H:i:s');
        $pagesTable = 'sparc_premiumgrains_pages';
        $projectsTable = 'sparc_premiumgrains_projects';
        $teamTable = 'sparc_premiumgrains_team_members';

        $teamMembers = [
            [
                'name' => 'Amina Tembo',
                'role' => 'Operations & partnerships',
                'bio' => 'Demo profile — replace this biography with the approved team story before launch.',
                'sort_order' => 1,
            ],
            [
                'name' => 'Chisomo Mbewe',
                'role' => 'Field programmes lead',
                'bio' => 'Demo profile — replace this biography with the approved team story before launch.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Thoko Phiri',
                'role' => 'Markets & finance',
                'bio' => 'Demo profile — replace this biography with the approved team story before launch.',
                'sort_order' => 3,
            ],
        ];

        foreach ($teamMembers as $member) {
            if (DB::table($teamTable)->where('name', $member['name'])->exists()) {
                continue;
            }

            DB::table($teamTable)->insert([
                'name' => $member['name'],
                'role' => $member['role'],
                'bio' => $member['bio'],
                'image' => null,
                'is_active' => true,
                'sort_order' => $member['sort_order'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $settings = Settings::instance();
        if (!$settings->contact_phone) {
            $settings->contact_phone = '+265 000 000 000';
        }
        if (!$settings->contact_address || $settings->contact_address === 'Malawi') {
            $settings->contact_address = 'Premium Grains House, Lilongwe (demo)';
        }
        if (!$settings->facebook_url) {
            $settings->facebook_url = 'https://example.com/premium-grains/facebook';
        }
        if (!$settings->instagram_url) {
            $settings->instagram_url = 'https://example.com/premium-grains/instagram';
        }
        if (!$settings->linkedin_url) {
            $settings->linkedin_url = 'https://example.com/premium-grains/linkedin';
        }
        if (!$settings->x_url) {
            $settings->x_url = 'https://example.com/premium-grains/x';
        }
        $settings->save();

        $bannerMap = [
            'home' => 'assets/images/hero-farmer.png',
            'about' => 'assets/images/banners/about-field-team.png',
            'model' => 'assets/images/banners/model-value-chain.png',
            'projects' => 'assets/images/banners/projects-community.png',
            'hubs' => 'assets/images/banners/hubs-maize-harvest.png',
            'partner' => 'assets/images/banners/partner-handshake.png',
            'contact' => 'assets/images/banners/contact-conversation.png',
            'saffei' => 'assets/images/banners/project-saffei-farmer.png',
            'journey' => 'assets/images/banners/project-saffei-farmer.png',
        ];

        foreach ($bannerMap as $code => $image) {
            DB::table($pagesTable)->where('code', $code)->update([
                'banner_image' => $image,
                'updated_at' => $now,
            ]);
        }

        DB::table($projectsTable)->where('slug', 'saffei')->update([
            'banner_image' => 'assets/images/banners/project-saffei-farmer.png',
            'updated_at' => $now,
        ]);
    }
}
