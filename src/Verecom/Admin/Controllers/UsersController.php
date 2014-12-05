<?php namespace Verecom\Admin\Controllers;

use View, Config, Redirect, Lang, Input;
use Verecom\Admin\User\Repo\AdminUserInterface;
use Verecom\Admin\User\Form\UserFormInterface;
use Verecom\Admin\Permission\Repo\PermissionInterface;
use Verecom\Admin\Group\Repo\AdminGroupInterface;
use Verecom\Admin\User\Repo\UserNotFoundException;

class UsersController extends BaseController {

    /**
     * @var \Verecom\Admin\User\Repo\AdminUserInterface
     */
    protected $users;

    /**
     * @var \Verecom\Admin\Permission\Form\PermissionFormInterface
     */
    protected $permissions;

    /**
     * @var \Verecom\Admin\Group\Repo\AdminGroupInterface
     */
    protected $groups;

    /**
     * @var \Verecom\Admin\User\Form\UserFormInterface
     */
    protected $userForm;

    /**
     * @param \Verecom\Admin\User\Repo\AdminUserInterface       $users
     * @param \Verecom\Admin\Permission\Repo\PermissionInterface $permissions
     * @param \Verecom\Admin\Group\Repo\AdminGroupInterface     $groups
     * @param \Verecom\Admin\User\Form\UserFormInterface         $userForm
     */
    public function __construct(
        AdminUserInterface $users,
        PermissionInterface $permissions,
        AdminGroupInterface $groups,
        UserFormInterface $userForm
    )
    {
        $this->users = $users;
        $this->permissions = $permissions;
        $this->groups = $groups;
        $this->userForm = $userForm;
    }

    /**
     * Show all the users
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = $this->users->findAll();
        return View::make(Config::get('admin::views.users_index'))
            ->with('users',$users);
    }

    /**
     * Show a user profile
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        try
        {
            $throttle = $this->users->getUserThrottle($id);
            $user = $throttle->getUser();
            $permissions = $user->getMergedPermissions();

            return View::make(Config::get('admin::views.users_show'))
                ->with('user',$user)
                ->with('groups',$user->getGroups())
                ->with('permissions',$permissions)
                ->with('throttle',$throttle);
        }
        catch ( UserNotFoundException $e)
        {
            return Redirect::route('admin.users.index')
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Display add user form
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $user = $this->users->getEmptyUser();

        $userPermissions = array();
        $genericPermissions = $this->permissions->generic();
        $modulePermissions = $this->permissions->module();


        //Get Groups
        $groups = $this->groups->findAll();

        return View::make(Config::get('admin::views.users_create'))
            ->with('user',$user)
            ->with('userPermissions',$userPermissions)
            ->with('genericPermissions',$genericPermissions)
            ->with('modulePermissions',$modulePermissions)
            ->with('groups',$groups);
    }

    /**
     * Display the user edit form
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        try
        {
            $user = $this->users->findById($id);
            $groups = $this->groups->findAll();

            $userPermissions = $user->getPermissions();
            $genericPermissions = $this->permissions->generic();
            $modulePermissions = $this->permissions->module();

            //get only the group id the user belong to
            $userGroupsId = array_pluck($user->getGroups()->toArray(), 'id');

            return View::make(Config::get('admin::views.users_edit'))
                ->with('user',$user)
                ->with('groups',$groups)
                ->with('userGroupsId',$userGroupsId)
                ->with('genericPermissions',$genericPermissions)
                ->with('modulePermissions',$modulePermissions)
                ->with('userPermissions',$userPermissions);
        }
        catch (UserNotFoundException $e)
        {
            return Redirect::route('admin.users.index')
                ->with('error',$e->getMessage());
        }
    }

    /**
     * Create a new user
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return Response
     */
    public function store()
    {
        $inputs = Input::except('groups', 'activate');
        $inputs['groups'] = Input::get('groups', array());
        $inputs['activate'] = Input::get('activate', false);

        if ( $this->userForm->create($inputs) )
        {
            return Redirect::route('admin.users.index')
                ->with('success', Lang::get('admin::users.create_success'));
        }

        return Redirect::back()
            ->withInput()
            ->withErrors($this->userForm->getErrors());
    }

    /**
     * Update user information
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id)
    {
        try
        {
            $credentials = Input::except('groups');
            $credentials['groups'] = Input::get('groups', array());
            $credentials['id'] = $id;


            if( $this->userForm->update($credentials) )
            {
                return Redirect::route('admin.users.index')
                    ->with('success', Lang::get('admin::users.update_success'));
            }

            return Redirect::back()
                ->withInput()
                ->withErrors($this->userForm->getErrors());
        }
        catch ( UserNotFoundException $e)
        {
            return Redirect::route('admin.users.index')
                    ->with('error', $e->getMessage());
        }
    }

    /**
     * Delete a user
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $currentUser = $this->users->getUser();

        if ($currentUser->id === (int) $id)
        {
            return Redirect::back()
                ->with('error', Lang::get('admin::users.delete_denied') );
        }

        try
        {
            $this->users->delete($id);
            return Redirect::route('admin.users.index')
                ->with('success',Lang::get('admin::users.delete_success'));
        }
        catch (UserNotFoundException $e)
        {
            return Redirect::route('admin.users.index')
                ->with('error',$e->getMessage());
        }
    }

    /**
     * deactivate a user
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function putDeactivate($id)
    {
        try
        {
            $this->users->deactivate($id);
            return Redirect::route('admin.users.index')
                ->with('success',Lang::get('admin::users.deactivation_success'));
        }
        catch (UserNotFoundException $e)
        {
            return Redirect::route('admin.users.index')
                ->with('error',$e->getMessage());
        }
    }

    /**
     * Activate a user
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function putActivate($id)
    {
        try
        {
            if ($this->users->activate($id))
            {
                // User activation passed
                return Redirect::route('admin.users.index')
                    ->with('success',Lang::get('admin::users.activation_success'));
            }
            else
            {
                // User activation failed
                return Redirect::route('admin.users.index')
                    ->with('error',Lang::get('admin::users.activation_fail'));
            }
        }
        catch (UserNotFoundException $e)
        {
            return Redirect::route('admin.users.index')
                ->with('error',$e->getMessage());
        }
    }

}
