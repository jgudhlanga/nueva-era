<?php

namespace App\Http\Composers;

use App\Http\Traits\General\CommonTrait;
use App\Services\Modules\ModuleService;
use App\Services\Users\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;

class CommonViewComposer
{
	use CommonTrait;
	
	protected $moduleService;
	protected $userService;
	
	public function __construct(ModuleService $moduleService, UserService $userService)
	{
		$this->moduleService = $moduleService;
		$this->userService = $userService;
	}
	
	/**
	 * @param View $view
	 */
	public function compose(View $view)
	{
		$systemModules = $this->moduleService->findAll(['status_id' => $this->getStatusActive()], null, null, ['position' => 'asc']);
		
		$modulesArray = [];
		
		if(count($systemModules) > 0)
		{
			foreach ($systemModules as $module)
			{
				array_push($modulesArray, strtolower($module->title));
			}
		}
		
		$currentModule = Request::segment(1);
		if((!empty($currentModule)) && (!in_array(strtolower($currentModule), $modulesArray))){
			$currentModule = 'cpanel';
		}
		
		$profilePicture = $this->userService->getUserProfilePicture(auth()->user());
		$userNames = (isset(auth()->user()->first_name)) ? auth()->user()->first_name .' '.auth()->user()->last_name : trans('general.people.unknown_user');
		$roles = (isset(auth()->user()->roles)) ? auth()->user()->roles : [];
		$userRoles = '';
		if(count($roles) > 0) {
		    foreach ($roles as $role) {
                $userRoles .= $role->display_name. ',';
            }
        }
		$data = [
			'systemModules' => $systemModules,
			'currentModule' => $currentModule,
			'profilePicture' => $profilePicture,
            'userNames' => $userNames,
            'userRoles' => ($userRoles != '') ? rtrim($userRoles, ',') : trans('general.people.unknown_role')
		];
		$view->with($data);
	}
	
}