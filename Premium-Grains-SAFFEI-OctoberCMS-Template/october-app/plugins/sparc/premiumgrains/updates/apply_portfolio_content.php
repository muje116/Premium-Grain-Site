<?php namespace Sparc\PremiumGrains\Updates;

use DB;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;
use Sparc\PremiumGrains\Models\Settings;

class ApplyPortfolioContent extends Migration
{
    public function up(): void
    {
        $now = date('Y-m-d H:i:s');
        $pagesTable = 'sparc_premiumgrains_pages';
        $projectsTable = 'sparc_premiumgrains_projects';
        $statsTable = 'sparc_premiumgrains_company_stats';
        $produceTable = 'sparc_premiumgrains_produce_lines';

        if (!Schema::hasTable($statsTable)) {
            Schema::create($statsTable, function (Blueprint $table) {
                $table->increments('id');
                $table->string('slug')->unique();
                $table->string('value');
                $table->string('label');
                $table->text('context')->nullable();
                $table->boolean('is_active')->default(true);
                $table->unsignedInteger('sort_order')->default(0);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable($produceTable)) {
            Schema::create($produceTable, function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('descriptor')->nullable();
                $table->text('body');
                $table->string('image')->nullable();
                $table->boolean('is_active')->default(true);
                $table->unsignedInteger('sort_order')->default(0);
                $table->timestamps();
            });
        }

        if (!Schema::hasColumn($projectsTable, 'video_path')) {
            Schema::table($projectsTable, function (Blueprint $table) {
                $table->string('video_path')->nullable()->after('banner_image');
            });
        }

        if (!Schema::hasColumn($projectsTable, 'gallery_images')) {
            Schema::table($projectsTable, function (Blueprint $table) {
                $table->text('gallery_images')->nullable()->after('video_path');
            });
        }

        foreach ([
            ['slug' => 'kasiya_footprint', 'value' => '480+', 'label' => 'hectares', 'context' => 'Kasiya agricultural footprint', 'sort_order' => 1],
            ['slug' => 'irrigation_schemes', 'value' => '7', 'label' => 'irrigation schemes', 'context' => 'Within the Kasiya footprint', 'sort_order' => 2],
            ['slug' => 'portfolio_farmers', 'value' => '290', 'label' => 'farmers', 'context' => 'Across the company portfolio', 'sort_order' => 3],
            ['slug' => 'lead_farmers', 'value' => '29', 'label' => 'lead farmers', 'context' => 'Supporting farmer organisation and learning', 'sort_order' => 4],
            ['slug' => 'sales_hubs', 'value' => '2', 'label' => 'sales hubs', 'context' => 'Connecting supply to domestic and regional buyers', 'sort_order' => 5],
            ['slug' => 'market_reach', 'value' => 'Export', 'label' => 'market route', 'context' => 'Domestic, regional and international opportunities', 'sort_order' => 6],
        ] as $stat) {
            $this->upsertBySlug($statsTable, $stat['slug'], $stat, $now);
        }

        foreach ([
            ['name' => 'Groundnuts', 'descriptor' => 'Crop production', 'body' => 'One of the agricultural value chains Premium Grains is developing from production and aggregation through market linkage and export.', 'image' => null, 'sort_order' => 1],
            ['name' => 'Soya beans', 'descriptor' => 'Crop production', 'body' => 'Part of the company portfolio connecting farmer production to reliable buyers and stronger value-chain participation.', 'image' => null, 'sort_order' => 2],
            ['name' => 'Rice', 'descriptor' => 'Crop production', 'body' => 'A production and trading opportunity within an integrated model built around aggregation, distribution and market access.', 'image' => null, 'sort_order' => 3],
            ['name' => 'Maize', 'descriptor' => 'Crop production', 'body' => 'A core staple value chain supported by production planning, farmer development and dependable commercial routes.', 'image' => null, 'sort_order' => 4],
            ['name' => 'Sunflower', 'descriptor' => 'Crop production', 'body' => 'Part of a diversified crop portfolio that helps strengthen resilience, income opportunities and market choice.', 'image' => null, 'sort_order' => 5],
            ['name' => 'Beans', 'descriptor' => 'Crop production', 'body' => 'A farmer-linked crop opportunity with room for aggregation, quality improvement and market connection.', 'image' => 'assets/images/company/red-beans.png', 'sort_order' => 6],
            ['name' => 'Bananas', 'descriptor' => 'Horticulture', 'body' => 'A horticultural value chain supported by the company\'s broader production, distribution and market-linkage ambitions.', 'image' => null, 'sort_order' => 7],
            ['name' => 'Horticultural produce', 'descriptor' => 'Diversified production', 'body' => 'A growing area for orchard, horticultural and value-addition opportunities across the company\'s farm and learning-centre network.', 'image' => 'assets/images/company/green-cover-crop.jpg', 'sort_order' => 8],
        ] as $line) {
            $this->upsertByName($produceTable, $line['name'], $line, $now);
        }

        $updatePage = function (string $code, array $data) use ($pagesTable, $now): void {
            DB::table($pagesTable)->where('code', $code)->update(array_merge($data, ['updated_at' => $now]));
        };

        $updatePage('home', [
            'label' => 'Home',
            'kicker' => 'Premium Grains Limited',
            'title' => "Growing markets.\nEmpowering farmers.\nBuilding resilient agriculture.",
            'intro' => 'Malawi | Integrated Agribusiness | Social Enterprise',
            'meta_title' => 'Premium Grains Limited | Growing markets. Empowering farmers.',
            'meta_description' => 'Premium Grains Limited is a Malawian integrated agribusiness and social enterprise building profitable, sustainable and inclusive agricultural value chains.',
        ]);

        $updatePage('about', [
            'label' => 'About',
            'kicker' => 'Who we are',
            'title' => 'Profitable, sustainable and inclusive agricultural value chains.',
            'intro' => 'Premium Grains Limited is a Malawian integrated agribusiness and social enterprise. We connect farmers to production support, practical knowledge and reliable markets while developing commercial farming, aggregation, horticulture, irrigation, distribution, export and value-addition opportunities.',
            'meta_title' => 'About Premium Grains Limited',
            'meta_description' => 'Learn how Premium Grains Limited connects farmers, production support and reliable markets across integrated agricultural value chains.',
        ]);

        $updatePage('model', [
            'label' => 'Our model',
            'kicker' => 'Seed to market',
            'title' => 'One connected agricultural value chain.',
            'intro' => 'Our model connects the full journey from Seed to Farmer, Production, Aggregation, Sales Hubs, Domestic Markets, Export Markets and Growth.',
            'meta_title' => 'Our agricultural model | Premium Grains Limited',
            'meta_description' => 'Explore the Premium Grains value chain from seed and farmer support through production, aggregation, sales hubs, domestic markets, export and growth.',
        ]);

        $updatePage('projects', [
            'label' => 'Projects',
            'kicker' => 'Projects in motion',
            'title' => 'Purpose becomes progress in the field.',
            'intro' => 'Premium Grains undertakes projects that respond to real needs in the field and connect them to practical commercial opportunity. SAFFEI is one project within the wider Premium Grains Limited platform.',
            'meta_title' => 'Projects | Premium Grains Limited',
            'meta_description' => 'Explore projects undertaken by Premium Grains Limited, including SAFFEI, its farmer-development project.',
        ]);

        $updatePage('hubs', [
            'label' => 'Farm hubs',
            'kicker' => 'Field presence',
            'title' => 'Production, learning and growth on the ground.',
            'intro' => 'Kasiya and Kabwafu/Mpherembe anchor Premium Grains production, farmer development and practical learning. They connect local implementation to a wider agricultural value chain.',
            'meta_title' => 'Farm hubs | Premium Grains Limited',
            'meta_description' => 'Explore the Kasiya and Kabwafu/Mpherembe farm hubs, learning centres and production footprint of Premium Grains Limited.',
        ]);

        $updatePage('partner', [
            'label' => 'Partner with us',
            'kicker' => 'Built for collaboration',
            'title' => 'Build the next value chain with us.',
            'intro' => 'We welcome partnerships with farmers, financial institutions, development organisations, input suppliers, processors, exporters, research institutions, government agencies and commercial off-takers.',
            'meta_title' => 'Partner with Premium Grains Limited',
            'meta_description' => 'Partner with Premium Grains Limited to connect organised farmers, field presence, production and dependable agricultural demand.',
        ]);

        $producePage = [
            'label' => 'Produce & trade',
            'kicker' => 'What we produce & trade',
            'title' => 'From production to profitable markets.',
            'intro' => 'Premium Grains participates across agricultural value chains including groundnuts, soya beans, rice, maize, sunflower, beans, bananas and horticultural produce.',
            'banner_image' => 'assets/images/company/green-cover-crop.jpg',
            'meta_title' => 'Produce & trade | Premium Grains Limited',
            'meta_description' => 'Explore the crops, agricultural value chains and market routes developed by Premium Grains Limited.',
            'sort_order' => 4,
        ];
        if (DB::table($pagesTable)->where('code', 'produce')->exists()) {
            $updatePage('produce', $producePage);
        } else {
            DB::table($pagesTable)->insert(array_merge(['code' => 'produce', 'is_active' => true, 'created_at' => $now], $producePage, ['updated_at' => $now]));
        }

        $updatePage('contact', [
            'meta_title' => 'Contact Premium Grains Limited',
            'meta_description' => 'Contact Premium Grains Limited about partnerships, projects, farmer development, agricultural production and markets.',
        ]);

        foreach ([
            ['number' => 1, 'title' => 'Vision', 'body' => 'To become a leading integrated agribusiness in Malawi, creating sustainable agricultural value chains that improve livelihoods, strengthen food security and connect African agriculture to profitable markets.'],
            ['number' => 2, 'title' => 'Mission', 'body' => 'To empower farmers through market access, quality inputs, innovative farming solutions and value addition while delivering premium agricultural products to domestic and international markets.'],
            ['number' => 3, 'title' => 'Core values', 'body' => 'Integrity, excellence, sustainability, innovation, accountability, partnership and community empowerment.'],
        ] as $principle) {
            DB::table('sparc_premiumgrains_principles')->where('number', $principle['number'])->update(array_merge($principle, ['updated_at' => $now]));
        }

        DB::table('sparc_premiumgrains_model_steps')->update(['is_active' => false, 'updated_at' => $now]);
        foreach ([
            ['number' => 1, 'short_code' => 'S', 'title' => 'Seed', 'body' => 'Quality inputs and production planning start the cycle.', 'sort_order' => 1],
            ['number' => 2, 'short_code' => 'F', 'title' => 'Farmer', 'body' => 'Farmer organisation, extension and practical knowledge make participation stronger.', 'sort_order' => 2],
            ['number' => 3, 'short_code' => 'P', 'title' => 'Production', 'body' => 'Commercial farming, climate-smart practices and crop diversification build a stronger supply base.', 'sort_order' => 3],
            ['number' => 4, 'short_code' => 'A', 'title' => 'Aggregation', 'body' => 'Quality control, bulking and coordinated collection connect farmer output to scale.', 'sort_order' => 4],
            ['number' => 5, 'short_code' => 'H', 'title' => 'Sales hubs', 'body' => 'Sales hubs support product movement, distribution and accessible market channels.', 'sort_order' => 5],
            ['number' => 6, 'short_code' => 'D', 'title' => 'Domestic markets', 'body' => 'Reliable local and national buyers create practical routes beyond the farm gate.', 'sort_order' => 6],
            ['number' => 7, 'short_code' => 'E', 'title' => 'Export markets', 'body' => 'Regional and international routes expand opportunity for Malawian agricultural produce.', 'sort_order' => 7],
            ['number' => 8, 'short_code' => 'G', 'title' => 'Growth', 'body' => 'Value addition, stronger incomes and reinvestment strengthen the next production cycle.', 'sort_order' => 8],
        ] as $step) {
            $this->upsertByNumber('sparc_premiumgrains_model_steps', $step['number'], $step, $now);
        }

        $this->upsertByName('sparc_premiumgrains_farm_hubs', 'Kasiya', [
            'location' => 'Lilongwe | Kasiya',
            'metric_label' => 'agricultural footprint',
            'metric_value' => '480+',
            'descriptor' => 'Production + farmer development',
            'points' => "480+ hectare agricultural footprint\nSeven irrigation schemes\n190 registered farmers and 19 lead farmers\n4-hectare SAFFEI Learning Centre\n6-hectare Premium Grains company farm",
            'accent' => 'light',
            'sort_order' => 1,
        ], $now);

        $this->upsertByName('sparc_premiumgrains_farm_hubs', 'Mpherembe', [
            'location' => 'Mzimba | Kabwafu / Mpherembe',
            'metric_label' => 'learning centre',
            'metric_value' => '4 ha',
            'descriptor' => 'Learning + horticulture',
            'points' => "4-hectare learning-centre site\nPractical agricultural learning environments\nProduction methods and technologies in use\nConnection to the wider Premium Grains value chain",
            'accent' => 'inverse',
            'sort_order' => 2,
        ], $now);

        $project = DB::table($projectsTable)->where('slug', 'saffei')->first();
        if ($project) {
            DB::table($projectsTable)->where('id', $project->id)->update([
                'kicker' => 'Featured project',
                'title' => 'Sustainable Agriculture and Farmer Financial Empowerment Initiative',
                'summary' => 'SAFFEI is Premium Grains Limited\'s farmer-development project connecting sustainable production, financial empowerment and market access.',
                'body' => 'SAFFEI is one project undertaken by Premium Grains Limited. It connects sustainable production with financial empowerment and market access. Giving a farmer seed alone is not enough: farmers should be supported to grow successfully, earn from reliable markets and thrive through stronger financial resilience.',
                'video_path' => 'assets/media/saffei-field.mp4',
                'gallery_images' => "assets/images/company/kasiya-compost.jpg\nassets/images/company/organic-material.jpg\nassets/images/company/green-cover-crop.jpg\nassets/images/company/red-beans.png",
                'stat_label' => 'Project motto',
                'stat_value' => 'Grow. Earn. Thrive.',
                'updated_at' => $now,
            ]);

            foreach ([
                ['category' => 'focus', 'number' => 1, 'title' => 'Sustainable agriculture', 'body' => 'Better production, knowledge, sustainable practices, inputs, soil conservation and climate-smart farming.'],
                ['category' => 'focus', 'number' => 2, 'title' => 'Financial empowerment', 'body' => 'Savings culture, financial literacy, Village Savings and Loan Associations and business-minded production.'],
                ['category' => 'focus', 'number' => 3, 'title' => 'Farmer capacity', 'body' => 'Lead farmers, practical extension, group learning and stronger farmer organisation.'],
                ['category' => 'focus', 'number' => 4, 'title' => 'Market connection', 'body' => 'Commercially viable crops, aggregation and market access that connect farmer effort to reliable demand.'],
            ] as $point) {
                $this->upsertProjectPoint($project->id, $point, $now);
            }
        }

        $settings = Settings::instance();
        $settings->brand_name = 'Premium Grains Limited';
        $settings->brand_descriptor = 'Malawi | Integrated Agribusiness | Social Enterprise';
        $settings->purpose = 'Premium Grains Limited is a Malawian integrated agribusiness and social enterprise building profitable, sustainable and inclusive agricultural value chains. We connect farmers to production support, practical knowledge and reliable markets while developing commercial farming, aggregation, horticulture, irrigation, distribution, export and value-addition opportunities.';
        $settings->approach = 'Seed → Farmer → Production → Aggregation → Sales Hubs → Domestic Markets → Export Markets → Growth.';
        $settings->farmer_quote = 'For a long time, one of our biggest challenges as farmers has been accessing good seed and knowing where we will sell after harvesting. Premium Grains coming to work with us gives us hope because they are supporting us with seed while also helping create a market for what we produce. It means we can farm knowing that there is a plan beyond the harvest.';
        $settings->farmer_quote_author = 'Mrs Mkandawire, Farmer, Kasiya';
        $settings->learning_centres_note = 'Premium Grains is developing practical agricultural learning environments where farmers can see technologies and production methods in use. Current learning-centre sites include 4 hectares in Kasiya and 4 hectares in Kabwafu/Mpherembe. Premium Grains also operates a 6-hectare company farm in Kasiya and has secured a 10-hectare site at Mude Farm under a three-year lease for progressive orchard and horticultural development.';
        $settings->footer_tagline = 'Growing markets. Empowering farmers. Building resilient agriculture.';
        $settings->motto = 'Grow. Earn. Thrive.';
        $settings->location_one = 'Kasiya, Lilongwe';
        $settings->location_two = 'Kabwafu / Mpherembe, Mzimba';
        $settings->location_country = 'Malawi';
        $settings->save();
    }

    private function upsertBySlug(string $table, string $slug, array $values, string $now): void
    {
        $existing = DB::table($table)->where('slug', $slug)->first();
        $payload = array_merge($values, ['slug' => $slug, 'is_active' => true, 'updated_at' => $now]);

        if ($existing) {
            DB::table($table)->where('id', $existing->id)->update($payload);
            return;
        }

        DB::table($table)->insert(array_merge($payload, ['created_at' => $now]));
    }

    private function upsertByName(string $table, string $name, array $values, string $now): void
    {
        $existing = DB::table($table)->where('name', $name)->first();
        $payload = array_merge($values, ['name' => $name, 'is_active' => true, 'updated_at' => $now]);

        if ($existing) {
            DB::table($table)->where('id', $existing->id)->update($payload);
            return;
        }

        DB::table($table)->insert(array_merge($payload, ['created_at' => $now]));
    }

    private function upsertByNumber(string $table, int $number, array $values, string $now): void
    {
        $existing = DB::table($table)->where('number', $number)->first();
        $payload = array_merge($values, ['number' => $number, 'is_active' => true, 'updated_at' => $now]);

        if ($existing) {
            DB::table($table)->where('id', $existing->id)->update($payload);
            return;
        }

        DB::table($table)->insert(array_merge($payload, ['created_at' => $now]));
    }

    private function upsertProjectPoint(int $projectId, array $point, string $now): void
    {
        $query = DB::table('sparc_premiumgrains_project_points')
            ->where('project_id', $projectId)
            ->where('category', $point['category'])
            ->where('number', $point['number']);
        $existing = $query->first();
        $payload = array_merge($point, ['project_id' => $projectId, 'is_active' => true, 'sort_order' => $point['number'], 'updated_at' => $now]);

        if ($existing) {
            $query->update($payload);
            return;
        }

        DB::table('sparc_premiumgrains_project_points')->insert(array_merge($payload, ['created_at' => $now]));
    }
}
