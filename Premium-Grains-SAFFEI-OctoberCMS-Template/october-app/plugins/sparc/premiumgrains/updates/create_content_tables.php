<?php namespace Sparc\PremiumGrains\Updates;

use DB;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;

class CreateContentTables extends Migration
{
    public function up(): void
    {
        Schema::create('sparc_premiumgrains_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('label');
            $table->string('kicker')->nullable();
            $table->text('title');
            $table->text('intro')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('sparc_premiumgrains_principles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('number')->default(1);
            $table->string('title');
            $table->text('body');
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('sparc_premiumgrains_model_steps', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('number')->default(1);
            $table->string('short_code', 4)->nullable();
            $table->string('title');
            $table->text('body');
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('sparc_premiumgrains_saffei_focus', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('number')->default(1);
            $table->string('title');
            $table->text('body');
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('sparc_premiumgrains_farm_hubs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('location');
            $table->string('metric_label')->nullable();
            $table->string('metric_value')->nullable();
            $table->string('descriptor')->nullable();
            $table->text('points');
            $table->string('accent')->default('light');
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('sparc_premiumgrains_journey_steps', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('number')->default(1);
            $table->string('title');
            $table->text('body');
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('sparc_premiumgrains_partner_points', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('number')->default(1);
            $table->string('title');
            $table->text('body');
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        $now = date('Y-m-d H:i:s');

        DB::table('sparc_premiumgrains_pages')->insert([
            [
                'code' => 'home',
                'label' => 'Home',
                'kicker' => 'Premium Grains x SAFFEI',
                'title' => "Growing value.\nStrengthening farmers.",
                'intro' => 'A modern Malawian agribusiness rooted in production, dependable markets and stronger livelihoods.',
                'meta_title' => 'Premium Grains x SAFFEI | Growing value',
                'meta_description' => 'Premium Grains and SAFFEI connect climate-smart production, farmer support and reliable agricultural markets across Malawi.',
                'sort_order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'about',
                'label' => 'About',
                'kicker' => 'Who we are',
                'title' => 'Building the path from field to market.',
                'intro' => 'Premium Grains Ltd is a Malawian commercial agribusiness building an integrated path from farm production to reliable markets. We work with farmers, cooperatives, buyers and partners to strengthen supply, improve quality and create sustainable income across agricultural value chains.',
                'meta_title' => 'About Premium Grains | Premium Grains x SAFFEI',
                'meta_description' => 'Learn how Premium Grains builds a resilient food and commodity business around farmer support, reliable markets and shared value.',
                'sort_order' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'model',
                'label' => 'Our model',
                'kicker' => 'Integrated agribusiness',
                'title' => 'From the field to the market',
                'intro' => 'Premium Grains combines commercial trading strength with practical farmer support. Each part of the model reinforces the next.',
                'meta_title' => 'Our model | Premium Grains x SAFFEI',
                'meta_description' => 'Explore the connected Premium Grains cycle: produce, support, aggregate, off-take and grow.',
                'sort_order' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'saffei',
                'label' => 'SAFFEI',
                'kicker' => 'The social enterprise arm',
                'title' => 'Meet SAFFEI',
                'intro' => "SAFFEI is Premium Grains' farmer-centred initiative. It connects agricultural production with financial resilience, conservation and structured off-take so that farming becomes a stronger and more sustainable livelihood.",
                'meta_title' => 'SAFFEI | Premium Grains x SAFFEI',
                'meta_description' => 'Meet SAFFEI, the farmer-centred initiative connecting sustainable agriculture, financial empowerment, farmer capacity and market connection.',
                'sort_order' => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'hubs',
                'label' => 'Farm hubs',
                'kicker' => 'Where the model comes alive',
                'title' => 'Our farm hubs',
                'intro' => 'Kasiya and Mpherembe anchor our practical work. They are places for production, demonstration, farmer learning and partnership activation.',
                'meta_title' => 'Farm hubs | Premium Grains x SAFFEI',
                'meta_description' => 'See how Kasiya in Lilongwe and Mpherembe in Mzimba anchor production, demonstration and farmer learning.',
                'sort_order' => 5,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'journey',
                'label' => 'SAFFEI journey',
                'kicker' => 'Designed around farmers',
                'title' => 'The SAFFEI journey',
                'intro' => 'A simple, disciplined cycle that starts with organisation and ends with income, learning and reinvestment.',
                'meta_title' => 'The SAFFEI journey | Premium Grains x SAFFEI',
                'meta_description' => 'Follow the six-step SAFFEI journey from farmer registration and preparation to harvest, income and reinvestment.',
                'sort_order' => 6,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'partner',
                'label' => 'Partner with us',
                'kicker' => 'Built for collaboration',
                'title' => 'Let us grow value together.',
                'intro' => 'Premium Grains offers a practical bridge between community-level implementation and commercial agricultural demand.',
                'meta_title' => 'Partner with Premium Grains | Premium Grains x SAFFEI',
                'meta_description' => 'Partner with Premium Grains and SAFFEI to connect organised farmers, field presence and dependable agricultural demand.',
                'sort_order' => 7,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        DB::table('sparc_premiumgrains_principles')->insert([
            ['number' => 1, 'title' => 'Vision', 'body' => 'To become a leading integrated agribusiness and trusted food distributor in Malawi.', 'sort_order' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['number' => 2, 'title' => 'Mission', 'body' => 'To empower farmers through production support, extension, value addition and structured market access.', 'sort_order' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['number' => 3, 'title' => 'Values', 'body' => 'Integrity, excellence, sustainability, innovation, accountability, partnership and community empowerment.', 'sort_order' => 3, 'created_at' => $now, 'updated_at' => $now],
        ]);

        DB::table('sparc_premiumgrains_model_steps')->insert([
            ['number' => 1, 'short_code' => 'P', 'title' => 'Produce', 'body' => 'Demonstration farming, climate-smart practices and crop planning at our farm hubs.', 'sort_order' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['number' => 2, 'short_code' => 'S', 'title' => 'Support', 'body' => 'Inputs, extension, training, farmer organisation and financial empowerment through SAFFEI.', 'sort_order' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['number' => 3, 'short_code' => 'A', 'title' => 'Aggregate', 'body' => 'Quality control, bulking and coordinated collection from farmers and cooperatives.', 'sort_order' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['number' => 4, 'short_code' => 'O', 'title' => 'Off-take', 'body' => "Reliable market access through Premium Grains' commercial buyer and distribution network.", 'sort_order' => 4, 'created_at' => $now, 'updated_at' => $now],
            ['number' => 5, 'short_code' => 'G', 'title' => 'Grow', 'body' => 'Value addition, stronger household income and reinvestment into the next production cycle.', 'sort_order' => 5, 'created_at' => $now, 'updated_at' => $now],
        ]);

        DB::table('sparc_premiumgrains_saffei_focus')->insert([
            ['number' => 1, 'title' => 'Sustainable agriculture', 'body' => 'Climate-smart practices, soil health, manure, demonstration plots and responsible land use.', 'sort_order' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['number' => 2, 'title' => 'Financial empowerment', 'body' => 'Village Savings and Loan Associations, savings culture, budgeting and business-minded production.', 'sort_order' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['number' => 3, 'title' => 'Farmer capacity', 'body' => 'Lead farmers, practical extension, group learning and stronger cooperative organisation.', 'sort_order' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['number' => 4, 'title' => 'Market connection', 'body' => 'Premium Grains aggregates and off-takes suitable produce, linking farmer effort to real demand.', 'sort_order' => 4, 'created_at' => $now, 'updated_at' => $now],
        ]);

        DB::table('sparc_premiumgrains_farm_hubs')->insert([
            [
                'name' => 'Kasiya',
                'location' => 'Lilongwe | T/A Kabudula',
                'metric_label' => 'demonstration farm',
                'metric_value' => '4 ha',
                'descriptor' => 'Demonstration + learning',
                'points' => "A 4-hectare demonstration and production farm\nPractical training and crop trials\nIntegrated crop and livelihood activities\nA learning point for surrounding farmer groups",
                'accent' => 'light',
                'sort_order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Mpherembe',
                'location' => 'Mzimba | T/A Mpherembe',
                'metric_label' => 'SAFFEI farmer network',
                'metric_value' => '190',
                'descriptor' => 'Farmer network + scale',
                'points' => "A Premium Grains farm and field implementation hub\nConnection to SAFFEI's 190-farmer network\nGroup-based extension and production planning\nAggregation and off-take potential across farmer land",
                'accent' => 'inverse',
                'sort_order' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        DB::table('sparc_premiumgrains_journey_steps')->insert([
            ['number' => 1, 'title' => 'Register', 'body' => 'Farmer profiling, land verification and production planning.', 'sort_order' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['number' => 2, 'title' => 'Organise', 'body' => 'Farmer groups, lead farmers and VSLA participation.', 'sort_order' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['number' => 3, 'title' => 'Prepare', 'body' => 'Training, soil and manure preparation, input planning and demonstrations.', 'sort_order' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['number' => 4, 'title' => 'Grow', 'body' => 'Extension follow-up, climate-smart production and quality monitoring.', 'sort_order' => 4, 'created_at' => $now, 'updated_at' => $now],
            ['number' => 5, 'title' => 'Harvest', 'body' => 'Aggregation, grading, traceability and coordinated collection.', 'sort_order' => 5, 'created_at' => $now, 'updated_at' => $now],
            ['number' => 6, 'title' => 'Earn + reinvest', 'body' => 'Off-take, household income, savings and preparation for the next cycle.', 'sort_order' => 6, 'created_at' => $now, 'updated_at' => $now],
        ]);

        DB::table('sparc_premiumgrains_partner_points')->insert([
            ['number' => 1, 'title' => 'Commercial route', 'body' => 'A functioning agribusiness platform for sourcing, aggregation, off-take and distribution.', 'sort_order' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['number' => 2, 'title' => 'Field presence', 'body' => 'Two farm hubs in Kasiya and Mpherembe that make training and demonstration practical.', 'sort_order' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['number' => 3, 'title' => 'Farmer structure', 'body' => 'An organised SAFFEI model built around groups, lead farmers, savings and extension.', 'sort_order' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['number' => 4, 'title' => 'Shared value', 'body' => 'A model that strengthens food security and livelihoods while building reliable supply.', 'sort_order' => 4, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('sparc_premiumgrains_partner_points');
        Schema::dropIfExists('sparc_premiumgrains_journey_steps');
        Schema::dropIfExists('sparc_premiumgrains_farm_hubs');
        Schema::dropIfExists('sparc_premiumgrains_saffei_focus');
        Schema::dropIfExists('sparc_premiumgrains_model_steps');
        Schema::dropIfExists('sparc_premiumgrains_principles');
        Schema::dropIfExists('sparc_premiumgrains_pages');
    }
}
