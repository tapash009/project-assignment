<?php

namespace App\Http\Controllers\Backend\Auth\User;

use App\Events\Backend\Auth\User\UserDeleted;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Auth\User\ManageUserRequest;
use App\Http\Requests\Backend\Auth\User\StoreUserRequest;
use App\Http\Requests\Backend\Auth\User\UpdateUserRequest;
use App\Models\Auth\User;
use App\Models\Country;
use App\Models\State;
use App\Repositories\Backend\Auth\PermissionRepository;
use App\Repositories\Backend\Auth\RoleRepository;
use App\Repositories\Backend\Auth\UserRepository;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class UserController.
 */
class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * UserController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param ManageUserRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageUserRequest $request)
    {
        return view('backend.auth.user.index')
            ->withUsers($this->userRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * @param ManageUserRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     *
     * @return mixed
     */
    public function create(ManageUserRequest $request, RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        return view('backend.auth.user.create')
            ->withCountries($this->userRepository->getCountries())
            ->withRoles($roleRepository->with('permissions')->get(['id', 'name']))
            ->withPermissions($permissionRepository->get(['id', 'name']));
    }

    /**
     * @param StoreUserRequest $request
     *
     * @throws \Throwable
     * @return mixed
     */
    public function store(StoreUserRequest $request)
    {
        $this->userRepository->create($request->only(
            'first_name',
            'last_name',
            'email',
            'username',
            'password',
            'dob',
            'country_id',
            'state_id',
            'city',
            'address'
        ));

        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.users.created'));
    }

    /**
     * @param ManageUserRequest $request
     * @param User              $user
     *
     * @return mixed
     */
    public function show(ManageUserRequest $request, User $user)
    {
        return view('backend.auth.user.show')
            ->withUser($user);
    }

    /**
     * @param ManageUserRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     * @param User                 $user
     *
     * @return mixed
     */
    public function edit(ManageUserRequest $request, RoleRepository $roleRepository, PermissionRepository $permissionRepository, User $user)
    {
        return view('backend.auth.user.edit')
            ->withUser($user)
            ->withCountries($this->userRepository->getCountries())
            ->withStates($this->userRepository->getStates($user->user_address->country_id))
            ->withRoles($roleRepository->get())
            ->withUserRoles($user->roles->pluck('name')->all())
            ->withPermissions($permissionRepository->get(['id', 'name']))
            ->withUserPermissions($user->permissions->pluck('name')->all());
    }

    /**
     * @param UpdateUserRequest $request
     * @param User              $user
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->userRepository->update($user, $request->only(
            'first_name',
            'last_name',
            'dob',
            'country_id',
            'state_id',
            'city',
            'address'

        ));

        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.users.updated'));
    }

    /**
     * @param ManageUserRequest $request
     * @param User              $user
     *
     * @throws \Exception
     * @return mixed
     */
    public function destroy(ManageUserRequest $request, User $user)
    {
        $this->userRepository->deleteById($user->id);

        event(new UserDeleted($user));

        return redirect()->route('admin.auth.user.deleted')->withFlashSuccess(__('alerts.backend.users.deleted'));
    }

    /**
     * @param $country_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStatesList($country_id){
        $responseData = ['message' => 'Something went wrong, please try again later', 'status_code' => 401];
        try{
            $states = State::where('country_id', $country_id)->get();
            if(count($states)>0) {
                $responseData['message'] = 'States list.';
                $responseData['data'] = $states;
                $responseData['status_code'] = 200;
            }else{
                $responseData['message'] = 'No data found.';
                $responseData['status_code'] = 204;
            }
        }catch (\Exception $exception){
            throw new HttpException(500, $exception->getMessage());
        }
        return response()->json($responseData);
    }

    /**
     * @param $username
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkUsername($username){
        $responseData = ['message' => 'Something went wrong, please try again later', 'status_code' => 401];
        try{
            $check_username = User::where('username', $username)->first();
            if($check_username) {
                $responseData['message'] = 'User found.';
                $responseData['status_code'] = 200;
            }else{
                $responseData['message'] = 'No data found.';
                $responseData['status_code'] = 204;
            }
        }catch (\Exception $exception){
            throw new HttpException(500, $exception->getMessage());
        }
        return response()->json($responseData);
    }

    public function checkEmail($email){
        $responseData = ['message' => 'Something went wrong, please try again later', 'status_code' => 401];
        try{
            $check_email = User::where('email', $email)->first();
            if($check_email) {
                $responseData['message'] = 'User found.';
                $responseData['status_code'] = 200;
            }else{
                $responseData['message'] = 'No data found.';
                $responseData['status_code'] = 204;
            }
        }catch (\Exception $exception){
            throw new HttpException(500, $exception->getMessage());
        }
        return response()->json($responseData);
    }
}
