<?php namespace Sparc\PremiumGrains\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class ContactMessages extends Controller
{
    public $implement = [
        \Backend\Behaviors\ListController::class,
    ];

    public $listConfig = 'config_list.yaml';
    public $requiredPermissions = ['sparc.premiumgrains.manage_content'];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Sparc.PremiumGrains', 'premiumgrains', 'contactmessages');
    }
}
