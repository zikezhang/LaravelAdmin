<?php namespace Verecom\Admin\Controllers;

use View, Config, Redirect, Lang;
use Verecom\Admin\User\Repo\AdminUserInterface;
use Verecom\Admin\User\Repo\UserNotFoundException;

class UsersThrottlingController extends BaseController {

    /**
     * @var AdminUserInterface
     */
    private $users;

    /**
     * @param AdminUserInterface $users
     */
    public function __construct(AdminUserInterface $users)
    {
        $this->users = $users;
    }


    /**
     * Show the user Throttling status
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getStatus($id)
    {
        try
        {
            $throttle = $this->users->getUserThrottle($id);
            $user = $throttle->getUser();
            return View::make(Config::get('admin::views.throttle_status'))
                ->with('user',$user)
                ->with('throttle',$throttle);
        }
        catch (UserNotFoundException $e)
        {
            return Redirect::route('admin.users.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Update the throttle status for a given user
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param $id
     * @param $action
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function putStatus($id, $action)
    {
        try
        {
            $this->users->updateThrottleStatus($id,$action);
            return Redirect::route('admin.users.index')
                ->with('success', Lang::get('admin::throttle.success',array('action' => $action)));

        }
        catch (UserNotFoundException $e)
        {
            return Redirect::route('admin.users.index')
                ->with('error', $e->getMessage());
        }
        catch (\BadMethodCallException $e)
        {
            return Redirect::route('admin.users.index')
                ->with('error', "This method is not suported [{$action}]");
        }
    }
}