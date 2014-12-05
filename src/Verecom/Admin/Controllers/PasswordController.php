<?php  namespace Verecom\Admin\Controllers; 

use View, Config, Input, Redirect, Mail, Event, Lang;
use Verecom\Admin\User\Repo\AdminUserInterface;
use Verecom\Admin\User\Repo\UserNotFoundException;
use Verecom\Admin\User\Form\PasswordFormInterface;

class PasswordController extends BaseController {

    /**
     * @var \Verecom\Admin\User\Repo\AdminInterface
     */
    private $users;

    /**
     * @var \Verecom\Admin\User\Form\PasswordFormInterface
     */
    private $passForm;

    /**
     * @param AdminUserInterface                             $users
     * @param \Verecom\Admin\User\Form\PasswordFormInterface $passForm
     */
    public function __construct(AdminUserInterface $users, PasswordFormInterface $passForm)
    {
        $this->users = $users;
        $this->passForm = $passForm;
    }

    /**
     * Display the reset password form
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return \Illuminate\View\View
     */
    public function getForgot()
    {
        return View::make(Config::get('admin::views.password_forgot'));
    }

    /**
     * Find the user and send a email with the reset code
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function postForgot()
    {
        try
        {
            $email = Input::get('email');
            $this->passForm->forgot($email);
            return View::make(Config::get('admin::views.password_send'))
                ->with('email', $email);
        }
        catch (UserNotFoundException $e)
        {
            return Redirect::back()
                ->with('password_error', $e->getMessage());
        }
    }

    /**
     * Display the password reset form
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param $code
     *
     * @return \Illuminate\View\View
     */
    public function getReset($code)
    {
        return View::make(Config::get('admin::views.password_reset'))
            ->with('code',$code);
    }

    /**
     *
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postReset()
    {
        $creds = array(
            'password' => Input::get('password'),
            'password_confirmation' => Input::get('password_confirmation'),
            'code' => Input::get('code')

        );

        if ($this->passForm->reset($creds))
        {
            return Redirect::route('admin.login')
                ->with('success', Lang::get('admin::users.password_reset_success'));
        }

        return Redirect::back()
            ->withInput()
            ->withErrors($this->passForm->getErrors());
    }

}
