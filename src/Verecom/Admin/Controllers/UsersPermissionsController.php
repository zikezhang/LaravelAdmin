<?php namespace Verecom\Admin\Controllers;

use View, Config, Redirect, Lang, Input;
use Verecom\Admin\Permission\Repo\PermissionInterface;
use Verecom\Admin\User\Repo\AdminUserInterface;
use Verecom\Admin\User\Repo\UserNotFoundException;

class UsersPermissionsController extends BaseController {


    /**
     * @var \Verecom\Admin\Permission\Repo\PermissionInterface
     */
    private $permissions;

    /**
     * @var \Verecom\Admin\User\Repo\AdminUserInterface
     */
    private $users;

    /**
     * @param \Verecom\Admin\Permission\Repo\PermissionInterface $permissions
     * @param \Verecom\Admin\User\Repo\AdminUserInterface       $users
     */
    public function __construct(PermissionInterface $permissions, AdminUserInterface $users)
    {
        $this->permissions = $permissions;
        $this->users = $users;
    }

    /**
     * Display the user permissins
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param  int $userId
     * @return Response
     */
    public function index($userId)
    {
        try
        {
            $user = $this->users->findById($userId);
            $userPermissions = $user->getPermissions();
            $genericPermissions = $this->permissions->generic();
            $modulePermissions = $this->permissions->module();

            return View::make(Config::get('admin::views.users_permission'))
                ->with('user',$user)
                ->with('userPermissions',$userPermissions)
                ->with('genericPermissions',$genericPermissions)
                ->with('modulePermissions',$modulePermissions);
        }
        catch ( UserNotFoundException $e)
        {
            return Redirect::route('admin.users.index')
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Update user permissions
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param  int $userId
     * @return Response
     */
    public function update($userId)
    {
        try
        {
            $permissions = Input::get('permissions', array());
            $this->users->updatePermissions($userId,$permissions);

            return Redirect::route('admin.users.index')
                ->with('success', Lang::get('admin::users.permissions_update_success'));
        }
        catch ( UserNotFoundException $e)
        {
            return Redirect::route('admin.users.permissions')
                ->with('error', $e->getMessage());
        }

    }

}
