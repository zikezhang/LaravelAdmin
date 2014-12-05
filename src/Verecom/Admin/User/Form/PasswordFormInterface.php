<?php namespace Verecom\Admin\User\Form;

interface PasswordFormInterface {

    /**
     * Get the validation errors
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return array
     */
    public function getErrors();

    /**
     *
     *
     * @author   ZZK
     * @link     http://verecom.com
     *
     * @param $email
     *
     * @return bool
     */
    public function forgot($email);

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
    public function reset(array $creds);

} 