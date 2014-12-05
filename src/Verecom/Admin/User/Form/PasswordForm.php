<?php namespace Verecom\Admin\User\Form;

use Event;
use Verecom\Admin\User\Repo\AdminUserInterface;
use Verecom\Admin\Services\Validation\ValidableInterface;
use Verecom\Admin\User\Repo\UserNotFoundException;
use Verecom\Admin\User\UserMailerInterface;

class PasswordForm implements PasswordFormInterface {

    /**
     * @var \Verecom\Admin\User\Repo\AdminUserInterface
     */
    protected $users;

    /**
     * @var ValidableInterface
     */
    protected $validator;

    /**
     * @var \Verecom\Admin\User\UserMailerInterface
     */
    protected $mailer;

    /**
     * @param ValidableInterface                       $validator
     * @param AdminUserInterface                      $users
     * @param \Verecom\Admin\User\UserMailerInterface $mailer
     */
    public function __construct(
        ValidableInterface $validator,
        AdminUserInterface $users,
        UserMailerInterface $mailer
    )
    {
        $this->users = $users;
        $this->validator = $validator;
        $this->mailer = $mailer;
    }

    /**
     *
     *
     * @author   ZZK
     * @link     http://verecom.com
     *
     * @param $email
     *
     * @return void
     */
    public function forgot($email)
    {
        $user = $this->users->findByLogin($email);
        $this->mailer->sendReset($user);
        Event::fire('users.password.forgot', array($user));
    }

    /**
     * Reset a given user password
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param array $creds
     *
     * @return bool
     */
    public function reset(array $creds)
    {
        try
        {
            if ($this->validator->with($creds)->passes())
            {
                $this->users->resetPassword($creds['code'],$creds['password']);
                return true;
            }
        }
        catch (UserNotFoundException $e)
        {
            $this->validator->add('UserNotFoundException',$e->getMessage());
        }

        return false;

    }

    /**
     * Get the validation errors
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->validator->errors();
    }
}