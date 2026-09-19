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
        $this->brand_descriptor = 'Projects & partnerships';
        $this->hero_image = 'assets/images/hero-farmer.png';
        $this->hero_cta_label = 'Explore our model';
        $this->hero_cta_url = '/our-model';
        $this->purpose = 'To grow a resilient food and commodity business that gives farmers access to practical support, dependable markets and opportunities to earn and thrive.';
        $this->approach = 'Commercial discipline + farmer development + climate-smart production + market access.';
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
        $this->footer_tagline = 'Growing value. Strengthening farmers.';
        $this->motto = 'Grown, Earn, Thrive';
    }
}
