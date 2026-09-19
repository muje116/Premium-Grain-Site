<?php namespace Sparc\PremiumGrains\Updates;

use DB;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;
use Sparc\PremiumGrains\Models\Settings;

class CreateProjectsTeamAndContact extends Migration
{
    public function up(): void
    {
        $pagesTable = 'sparc_premiumgrains_pages';
        $projectsTable = 'sparc_premiumgrains_projects';
        $pointsTable = 'sparc_premiumgrains_project_points';
        $teamTable = 'sparc_premiumgrains_team_members';
        $messagesTable = 'sparc_premiumgrains_contact_messages';

        if (!Schema::hasColumn($pagesTable, 'banner_image')) {
            Schema::table($pagesTable, function (Blueprint $table) {
                $table->string('banner_image')->nullable()->after('intro');
            });
        }

        if (!Schema::hasTable($projectsTable)) {
            Schema::create($projectsTable, function (Blueprint $table) {
                $table->increments('id');
                $table->string('slug')->unique();
                $table->string('name');
                $table->string('kicker')->nullable();
                $table->text('title');
                $table->text('summary')->nullable();
                $table->text('body')->nullable();
                $table->string('banner_image')->nullable();
                $table->string('stat_label')->nullable();
                $table->string('stat_value')->nullable();
                $table->string('accent')->default('forest');
                $table->boolean('is_featured')->default(false);
                $table->boolean('is_active')->default(true);
                $table->unsignedInteger('sort_order')->default(0);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable($pointsTable)) {
            Schema::create($pointsTable, function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('project_id');
                $table->string('category')->default('focus');
                $table->unsignedInteger('number')->default(1);
                $table->string('title');
                $table->text('body');
                $table->boolean('is_active')->default(true);
                $table->unsignedInteger('sort_order')->default(0);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable($teamTable)) {
            Schema::create($teamTable, function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('role');
                $table->text('bio')->nullable();
                $table->string('image')->nullable();
                $table->boolean('is_active')->default(true);
                $table->unsignedInteger('sort_order')->default(0);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable($messagesTable)) {
            Schema::create($messagesTable, function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('email');
                $table->string('phone')->nullable();
                $table->string('enquiry_type')->nullable();
                $table->text('message');
                $table->boolean('is_read')->default(false);
                $table->timestamp('read_at')->nullable();
                $table->timestamps();
            });
        }

        $now = date('Y-m-d H:i:s');
        $project = DB::table($projectsTable)->where('slug', 'saffei')->first();

        if (!$project) {
            $projectId = DB::table($projectsTable)->insertGetId([
                'slug' => 'saffei',
                'name' => 'SAFFEI',
                'kicker' => 'Featured project',
                'title' => 'Sustainable agriculture and financial empowerment in practice.',
                'summary' => 'A farmer-centred Premium Grains project connecting sustainable production, financial resilience, practical capacity and dependable markets.',
                'body' => 'SAFFEI is a Premium Grains project, not the whole business. It connects agricultural production with financial resilience, conservation and structured off-take so farming can become a stronger and more sustainable livelihood.',
                'banner_image' => 'assets/images/hero-farmer.png',
                'stat_label' => 'Project promise',
                'stat_value' => 'Grown · Earn · Thrive',
                'accent' => 'forest',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        } else {
            $projectId = $project->id;
        }

        if (!DB::table($pointsTable)->where('project_id', $projectId)->exists()) {
            DB::table($pointsTable)->insert([
                ['project_id' => $projectId, 'category' => 'focus', 'number' => 1, 'title' => 'Sustainable agriculture', 'body' => 'Climate-smart practices, soil health, manure, demonstration plots and responsible land use.', 'sort_order' => 1, 'created_at' => $now, 'updated_at' => $now],
                ['project_id' => $projectId, 'category' => 'focus', 'number' => 2, 'title' => 'Financial empowerment', 'body' => 'Village Savings and Loan Associations, savings culture, budgeting and business-minded production.', 'sort_order' => 2, 'created_at' => $now, 'updated_at' => $now],
                ['project_id' => $projectId, 'category' => 'focus', 'number' => 3, 'title' => 'Farmer capacity', 'body' => 'Lead farmers, practical extension, group learning and stronger cooperative organisation.', 'sort_order' => 3, 'created_at' => $now, 'updated_at' => $now],
                ['project_id' => $projectId, 'category' => 'focus', 'number' => 4, 'title' => 'Market connection', 'body' => 'Premium Grains aggregates and off-takes suitable produce, linking farmer effort to real demand.', 'sort_order' => 4, 'created_at' => $now, 'updated_at' => $now],
                ['project_id' => $projectId, 'category' => 'journey', 'number' => 1, 'title' => 'Register', 'body' => 'Farmer profiling, land verification and production planning.', 'sort_order' => 1, 'created_at' => $now, 'updated_at' => $now],
                ['project_id' => $projectId, 'category' => 'journey', 'number' => 2, 'title' => 'Organise', 'body' => 'Farmer groups, lead farmers and VSLA participation.', 'sort_order' => 2, 'created_at' => $now, 'updated_at' => $now],
                ['project_id' => $projectId, 'category' => 'journey', 'number' => 3, 'title' => 'Prepare', 'body' => 'Training, soil and manure preparation, input planning and demonstrations.', 'sort_order' => 3, 'created_at' => $now, 'updated_at' => $now],
                ['project_id' => $projectId, 'category' => 'journey', 'number' => 4, 'title' => 'Grow', 'body' => 'Extension follow-up, climate-smart production and quality monitoring.', 'sort_order' => 4, 'created_at' => $now, 'updated_at' => $now],
                ['project_id' => $projectId, 'category' => 'journey', 'number' => 5, 'title' => 'Harvest', 'body' => 'Aggregation, grading, traceability and coordinated collection.', 'sort_order' => 5, 'created_at' => $now, 'updated_at' => $now],
                ['project_id' => $projectId, 'category' => 'journey', 'number' => 6, 'title' => 'Earn + reinvest', 'body' => 'Off-take, household income, savings and preparation for the next cycle.', 'sort_order' => 6, 'created_at' => $now, 'updated_at' => $now],
            ]);
        }

        if (!DB::table($pagesTable)->where('code', 'projects')->exists()) {
            DB::table($pagesTable)->insert([
                'code' => 'projects',
                'label' => 'Projects',
                'kicker' => 'Projects in motion',
                'title' => 'Purpose becomes progress in the field.',
                'intro' => 'Explore the projects Premium Grains undertakes with farmers, communities and partners. SAFFEI is one project within a bigger, growing business.',
                'banner_image' => 'assets/images/hero-farmer.png',
                'meta_title' => 'Projects | Premium Grains',
                'meta_description' => 'Explore Premium Grains projects, including SAFFEI, and see how each one creates practical value for farmers and partners.',
                'sort_order' => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        if (!DB::table($pagesTable)->where('code', 'contact')->exists()) {
            DB::table($pagesTable)->insert([
                'code' => 'contact',
                'label' => 'Contact',
                'kicker' => 'Start a conversation',
                'title' => 'Let us grow value together.',
                'intro' => 'Tell us what you are building, where you are working and how you see a useful connection with Premium Grains.',
                'banner_image' => 'assets/images/hero-farmer.png',
                'meta_title' => 'Contact Premium Grains',
                'meta_description' => 'Contact the Premium Grains team about partnerships, projects, farmer support and agricultural markets.',
                'sort_order' => 8,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        DB::table($pagesTable)->whereNull('banner_image')->update([
            'banner_image' => 'assets/images/hero-farmer.png',
            'updated_at' => $now,
        ]);

        DB::table($pagesTable)->where('code', 'home')->update([
            'kicker' => 'Premium Grains',
            'meta_title' => 'Premium Grains | Grown, Earn, Thrive',
            'meta_description' => 'Premium Grains is a Malawian agribusiness building practical value from farm production to dependable markets.',
            'updated_at' => $now,
        ]);

        foreach (['about', 'model', 'hubs', 'partner'] as $code) {
            DB::table($pagesTable)->where('code', $code)->update([
                'meta_title' => ucfirst($code === 'hubs' ? 'farm hubs' : $code) . ' | Premium Grains',
                'updated_at' => $now,
            ]);
        }

        DB::table($pagesTable)->whereIn('code', ['saffei', 'journey'])->update([
            'is_active' => false,
            'label' => 'Legacy project redirect',
            'updated_at' => $now,
        ]);

        $settings = Settings::instance();
        if (!$settings->brand_descriptor || $settings->brand_descriptor === 'SAFFEI Project') {
            $settings->brand_descriptor = 'Projects & partnerships';
        }
        if (!$settings->motto || $settings->motto === 'Tilime. Tikolole. Titukuke.') {
            $settings->motto = 'Grown, Earn, Thrive';
        }
        if (!$settings->contact_address) {
            $settings->contact_address = 'Malawi';
        }
        $settings->save();
    }
}
