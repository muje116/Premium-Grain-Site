<?php namespace Sparc\PremiumGrains\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class TeamMembers extends Controller
{
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $crudBase = 'sparc/premiumgrains/teammembers';
    public $requiredPermissions = ['sparc.premiumgrains.manage_content'];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Sparc.PremiumGrains', 'premiumgrains', 'teammembers');
    }
}
