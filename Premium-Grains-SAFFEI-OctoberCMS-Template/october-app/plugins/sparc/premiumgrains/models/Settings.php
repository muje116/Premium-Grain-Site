<?php namespace Sparc\PremiumGrains\Models;

use System\Models\SettingModel;

class Settings extends SettingModel
{
    public $settingsCode = 'sparc_premiumgrains_settings';

    public $settingsFields = 'fields.yaml';

    public $rules = [
        'brand_name' => 'required',
        'partnership_email' => 'required|email',
    ];

    public function initSettingsData(): void
    {
        $this->brand_name = 'Premium Grains';
        $this->brand_descriptor = 'Malawi | Integrated agribusiness | Social enterprise';
        $this->hero_image = 'assets/images/hero-farmer.png';
        $this->hero_cta_label = 'Explore our model';
        $this->hero_cta_url = '/our-model';
        $this->purpose = 'Premium Grains Limited is a Malawian integrated agribusiness and social enterprise building profitable, sustainable and inclusive agricultural value chains. We connect farmers to production support, practical knowledge and reliable markets while developing commercial farming, aggregation, horticulture, irrigation, distribution, export and value-addition opportunities.';
        $this->approach = 'Seed → Farmer → Production → Aggregation → Sales Hubs → Domestic Markets → Export Markets → Growth.';
        $this->farmer_quote = 'For a long time, one of our biggest challenges as farmers has been accessing good seed and knowing where we will sell after harvesting. Premium Grains coming to work with us gives us hope because they are supporting us with seed while also helping create a market for what we produce. It means we can farm knowing that there is a plan beyond the harvest.';
        $this->farmer_quote_author = 'Mrs Mkandawire, Farmer, Kasiya';
        $this->learning_centres_note = 'Premium Grains is developing practical agricultural learning environments where farmers can see technologies and production methods in use. Current learning-centre sites include 4 hectares in Kasiya and 4 hectares in Kabwafu/Mpherembe. Premium Grains also operates a 6-hectare company farm in Kasiya and has secured a 10-hectare site at Mude Farm under a three-year lease for progressive orchard and horticultural development.';
        $this->partnership_email = 'hello@premiumgrains.mw';
        $this->contact_phone = '';
        $this->contact_address = 'Malawi';
        $this->facebook_url = '';
        $this->instagram_url = '';
        $this->linkedin_url = '';
        $this->x_url = '';
        $this->location_one = 'Kasiya, Lilongwe';
        $this->location_two = 'Mpherembe, Mzimba';
        $this->location_country = 'Malawi';
        $this->footer_tagline = 'Growing markets. Empowering farmers. Building resilient agriculture.';
        $this->motto = 'Grow. Earn. Thrive.';
    }
}
