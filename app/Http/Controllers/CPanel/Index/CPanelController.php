<?php

namespace App\Http\Controllers\CPanel\Index;

use App\Http\Controllers\Controller;
use App\Services\General\GeneralService;
use App\Services\Modules\ModuleService;
use App\Services\General\CountryService;
use App\Services\General\StatusService;
use App\Services\Security\PermissionService;
use App\Services\Security\RoleService;

/**
 * Class CpanelController
 * @package App\Http\Controllers\CPanel\Index
 */
class CpanelController extends Controller
{
	/**
	 * @var ModuleService
	 */
	protected $moduleService;

	/**
	 * @var StatusService
	 */
	protected $statusService;

	/**
	 * @var CountryService
	 */
	protected $countryService;

    /**
     * @var RoleService
     */
	protected $roleService;
	/**
	 * @var PermissionService
	 */
	protected $permissionService;

    /**
     * @var GeneralService
     */
	protected $generalService;

    /**
     * CpanelController constructor.
     * @param ModuleService $modulesService
     * @param StatusService $statusService
     * @param CountryService $countryService
     * @param PermissionService $permissionService
     * @param RoleService $roleService
     * @param GeneralService $generalService
     */
	public function __construct(ModuleService $modulesService, StatusService $statusService,
	    CountryService $countryService,PermissionService $permissionService,
	    RoleService $roleService, GeneralService $generalService)
    {
        $this->moduleService = $modulesService;
	    $this->statusService = $statusService;
	    $this->countryService = $countryService;
	    $this->permissionService = $permissionService;
	    $this->roleService = $roleService;
	    $this->generalService = $generalService;
    }
	
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
    {
        $moduleCount = $this->moduleService->count(null);
	    $statusCount = $this->statusService->count(null);
	    $iconCount = $this->generalService->count($this->generalService->initializeModel('Icon'));
	    $titleCount = $this->generalService->count($this->generalService->initializeModel('Title'));
	    $maritalStatusCount = $this->generalService->count($this->generalService->initializeModel('MaritalStatus'));
	    $genderCount = $this->generalService->count($this->generalService->initializeModel('Gender'));
	    $occupationCount = $this->generalService->count($this->generalService->initializeModel('Occupation'));
	    $raceCount = $this->generalService->count($this->generalService->initializeModel('Race'));
	    $countryCount = $this->countryService->count(null);
	    $memberTypeCount = $this->generalService->count($this->generalService->initializeModel('MemberType'));
	    $addressTypeCount = $this->generalService->count($this->generalService->initializeModel('AddressType'));
	    $permissionCount = $this->permissionService->count(null);
	    $roleCount = $this->roleService->count(null);
	    $args = ['moduleCount' => $moduleCount,'statusCount' => $statusCount,'iconCount' => $iconCount,
            'titleCount' => $titleCount,'maritalStatusCount' => $maritalStatusCount, 'genderCount' => $genderCount,
            'occupationCount' => $occupationCount, 'raceCount' => $raceCount, 'countryCount' => $countryCount,
            'memberTypeCount' => $memberTypeCount, 'addressTypeCount' => $addressTypeCount, 'permissionCount' => $permissionCount,
            'roleCount' => $roleCount];
        return view('cpanel.index.index')->with($args);
    }
   
}
