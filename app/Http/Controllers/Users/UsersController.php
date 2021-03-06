<?php

namespace App\Http\Controllers\Users;

use App\Http\Requests\Users\UserRequest;
use App\Http\Traits\People\PeopleTrait;
use App\Models\Users\User;
use App\Services\General\StatusService;
use App\Services\Security\RoleService;
use App\Services\Users\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\File;

/**
 * Class UsersController
 * @package App\Http\Controllers\Users
 */
class UsersController extends Controller
{
    use PeopleTrait;
	/**
	 * @var UserService
	 */
	protected $userService;

	/**
	 * @var RoleService
	 */
	protected $roleService;

    /**
     * @var StatusService
     */
	protected $statusService;

    /**
     * UsersController constructor.
     * @param UserService $userService
     * @param RoleService $roleService
     * @param StatusService $statusService
     */
	public function __construct(UserService $userService, RoleService $roleService,
                                StatusService $statusService)
    {
    	$this->userService = $userService;
    	$this->roleService = $roleService;
    	$this->statusService = $statusService;
    }
	
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
    {
        return view('users.index');
    }
	
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function create()
    {
    	$roles = $this->roleService->findAll(['status_id' => $this->statusService->statusActive()]);
        $args = [
            'titles' => $this->titleOptions(), 'genders' => $this->genderOptions(), 'roles' => $roles
        ];
    	return view('users.create')->with($args);
    }
    
	
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function dashboard()
    {
    	return view('users.dashboard');
    }
	
	/**
	 * @param UserRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
	public function store(UserRequest $request)
	{
		try{
			DB::beginTransaction();
			$user = $this->userService->create($request);
			if($user instanceof User) {
				$created = $user;
				$status = Response::HTTP_CREATED;
				$message = trans('users.alerts.created');
			}
			else{
				$created = null;
				$status = Response::HTTP_INTERNAL_SERVER_ERROR;
				$message = trans('users.alerts.error');
			}
			DB::commit();
			return response()->json(['user' => $created, 'message' => $message], $status);
		}
		catch (\Exception $e)
		{
			throw new \Exception($e->getMessage());
		}
	}
	
	/**
	 * @param User $user
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function show(User $user)
	{
		/* Profile picture */
		$user->profile_picture = $this->userService->getUserProfilePicture($user);
		$roles = $this->roleService->findAll(['status_id' => $this->statusService->statusActive()]);
		$userRoles = (count($user->roles) > 0) ? $user->roles()->pluck('id')->all() : [];
        $args = [
            'titles' => $this->titleOptions(), 'genders' => $this->genderOptions(),
            'roles' => $roles, 'userRoles' => $userRoles, 'user' => $user
        ];

        return view('users.edit')->with($args);
	}
	
	/**
	 * @param User $user
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
	 */
	public function edit(User $user)
	{
		if($user instanceof User){
			return response([
				'data' => $user
			], Response::HTTP_OK);
		}
		else{
			notify()->flash(trans('users.not_found'), 'error');
		}
	}
	
	/**
	 * @param Request $request
	 * @param User $user
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
	public function update(Request $request, User $user)
	{
		try{
			DB::beginTransaction();
			
			$user = $this->userService->update($user, $request);
			
			if($user instanceof User) {
				$updated = $user;
				$status = Response::HTTP_CREATED;
				$message = trans('users.alerts.updated');
			}
			else{
				$updated = null;
				$status = Response::HTTP_INTERNAL_SERVER_ERROR;
				$message = trans('users.alerts.error');
			}
			DB::commit();
			return response()->json(['user' => $updated, 'message' => $message], $status);
		}
		catch (\Exception $e)
		{
			throw new \Exception($e->getMessage());
		}
	}
	
	/**
	 * @param User $user
	 * @throws \Exception
	 */
	public function destroy(User $user)
	{
		try{
			$this->userService->delete($user);
		}
		catch (\Exception $e) {
			throw new \Exception($e->getMessage());
		}
	}
}
