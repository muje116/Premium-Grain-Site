<?php namespace Sparc\PremiumGrains\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use October\Rain\Exception\ValidationException;
use Flash;
use Sparc\PremiumGrains\Models\FarmHub;
use Sparc\PremiumGrains\Models\ModelStep;
use Sparc\PremiumGrains\Models\Page;
use Sparc\PremiumGrains\Models\PartnerPoint;
use Sparc\PremiumGrains\Models\Principle;
use Sparc\PremiumGrains\Models\Project;
use Sparc\PremiumGrains\Models\ProjectPoint;
use Sparc\PremiumGrains\Models\Settings;
use Sparc\PremiumGrains\Models\TeamMember;
use Sparc\PremiumGrains\Models\ContactMessage;

class PremiumContent extends ComponentBase
{
    public function componentDetails(): array
    {
        return [
            'name' => 'Premium Grains content',
            'description' => 'Loads editable Premium Grains and SAFFEI content for a page.',
        ];
    }

    public function defineProperties(): array
    {
        return [
            'pageCode' => [
                'title' => 'Page code',
                'description' => 'The content record to use for the current page.',
                'type' => 'string',
                'default' => 'home',
            ],
            'projectSlug' => [
                'title' => 'Project slug',
                'description' => 'Optional project slug used by the project detail page.',
                'type' => 'string',
                'default' => '',
            ],
        ];
    }

    public function onRun(): void
    {
        $pages = Page::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->keyBy('code');

        $this->page['site'] = Settings::instance();
        $this->page['pages'] = $pages;
        $this->page['pageContent'] = $pages->get($this->property('pageCode'));
        $this->page['projects'] = Project::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
        $this->page['teamMembers'] = TeamMember::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
        $this->page['principles'] = Principle::where('is_active', true)->orderBy('sort_order')->get();
        $this->page['modelSteps'] = ModelStep::where('is_active', true)->orderBy('sort_order')->get();
        $this->page['farmHubs'] = FarmHub::where('is_active', true)->orderBy('sort_order')->get();
        $this->page['partnerPoints'] = PartnerPoint::where('is_active', true)->orderBy('sort_order')->get();

        $projectSlug = $this->property('projectSlug') ?: Request::route('slug');
        $project = $projectSlug
            ? Project::where('slug', $projectSlug)->where('is_active', true)->first()
            : null;

        $this->page['project'] = $project;
        $this->page['projectPoints'] = $project
            ? ProjectPoint::where('project_id', $project->id)
                ->where('category', 'focus')
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get()
            : collect();
        $this->page['projectJourney'] = $project
            ? ProjectPoint::where('project_id', $project->id)
                ->where('category', 'journey')
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get()
            : collect();
    }

    public function onSubmitContact(): array
    {
        $data = Request::only(['name', 'email', 'phone', 'enquiry_type', 'message']);
        $validator = Validator::make($data, [
            'name' => 'required|max:160',
            'email' => 'required|email|max:190',
            'phone' => 'nullable|max:60',
            'enquiry_type' => 'required|max:120',
            'message' => 'required|max:5000',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        ContactMessage::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'enquiry_type' => $data['enquiry_type'],
            'message' => $data['message'],
            'is_read' => false,
        ]);

        Flash::success('Thanks for reaching out. Our team will be in touch soon.');

        return ['success' => true];
    }
}
