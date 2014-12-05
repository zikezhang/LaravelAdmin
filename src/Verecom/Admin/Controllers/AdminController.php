<?php namespace Verecom\Admin\Controllers;

use View, Config, Input, Redirect, Lang;
use Verecom\Admin\User\Repo\AdminUserInterface;
use Verecom\Admin\User\Form\UserFormInterface;


class AdminController extends BaseController {

    /**
     * @var \Verecom\Admin\User\Repo\AdminUserInterface
     */
    private $users;

    /**
     * @var \Verecom\Admin\User\Form\UserFormInterface
     */
    private $userForm;

    /**
     * @param AdminUserInterface                         $users
     * @param \Verecom\Admin\User\Form\UserFormInterface $userForm
     */
    public function __construct(AdminUserInterface $users, UserFormInterface $userForm)
    {
        $this->users = $users;
        $this->userForm = $userForm;
    }


    /**
     * Show the dashboard
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return View::make(Config::get('admin::views.dashboard'));
    }

    /**
     * Show the login form
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return \Illuminate\View\View
     */
    public function getLogin()
    {
        $login_attribute = Config::get('cartalyst/sentry::users.login_attribute');
        return View::make(Config::get('admin::views.login'), compact('login_attribute'));
    }

    /**
     * Display the registration form
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return \Illuminate\View\View
     */
    public function getRegister()
    {
        $login_attribute = Config::get('cartalyst/sentry::users.login_attribute');
        return View::make(Config::get('admin::views.register'), compact('login_attribute'));
    }

    /**
     * Logs out the current user
     *
     * @author ZZK
     * @link    http://verecom.com
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLogout()
    {
        $this->users->logout();
        return Redirect::route('admin.login')
            ->with('success', Lang::get('admin::users.logout'));
    }

    /**
     * Authenticate the user
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin()
    {
        $remember = Input::get('remember_me', false);
        $userdata = array(
            Config::get('cartalyst/sentry::users.login_attribute') => Input::get('login_attribute'),
            'password' => Input::get('password')
        );

        if ( $this->userForm->login($userdata,$remember) )
        {
            return Redirect::intended(Config::get('admin::prefix', 'admin'))
                ->with('success', Lang::get('admin::users.login_success'));
        }

        return Redirect::back()
            ->withInput()
            ->with('login_error',$this->userForm->getErrors()->first());


    }

    /**
     * Register user
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRegister()
    {
        if( $this->userForm->register(Input::all(),false) )
        {
            return Redirect::route('admin.login')
                ->with('success', Lang::get('admin::users.register_success'));
        }

        return Redirect::back()
            ->withInput()
            ->withErrors($this->userForm->getErrors());

    }
    
}