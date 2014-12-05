<?php namespace Verecom\Admin\User;

use Cartalyst\Sentry\Users\UserInterface;

interface UserMailerInterface {

    /**
     * Send a email to a given user with a link to reset is password
     *
     * @author Steve Montambeault
     * @link   http://verecom.com
     *
     * @param UserInterface $user
     *
     * @return void
     */
    public function sendReset(UserInterface $user);
} 