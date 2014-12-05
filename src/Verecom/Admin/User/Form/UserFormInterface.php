<?php namespace Verecom\Admin\User\Form;

interface UserFormInterface {

    /**
     * Validate and create the user
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param array $data
     *
     * @return \StdClass
     */
    public function create(array $data);

    /**
     * Validate and log in a user
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param array $credentials
     * @param bool  $remember
     *
     * @return bool
     */
    public function login(array $credentials, $remember);

    /**
     * Register a new user
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param array $credentials
     * @param bool  $activate
     *
     * @return bool
     */
    public function register(array $credentials, $activate);

    /**
     * Validate and update a existing user
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param array $data
     *
     * @return bool
     */
    public function update(array $data);

    /**
     * Get the validation errors
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return array
     */
    public function getErrors();
} 