<?php namespace Verecom\Admin\User\Repo;

interface AdminUserInterface {

    /**
     * Activate a user
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param $id
     *
     * @return bool
     */
    public function activate($id);

    /**
     * Attempts to authenticate the given user
     * according to the passed credentials.
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param array $credentials
     * @param bool  $remember
     *
     * @return \Cartalyst\Sentry\Users\UserInterface
     */
    public function authenticate(array $credentials, $remember = false);

    /**
     * Check to see if the user is logged in and activated, and hasn't been banned or suspended.
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return bool
     */
    public function check();

    /**
     * Create a new user
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param array $credentials
     * @param bool  $activate
     *
     * @return \Cartalyst\Sentry\Users\UserInterface
     */
    public function create(array $credentials, $activate = false);

    /**
     * De activate a user
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param $id
     *
     * @return bool
     */
    public function deactivate($id);

    /**
     * Delete the user
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param int $id
     *
     * @return void
     */
    public function delete($id);

    /**
     * Returns an all users.
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return array
     */
    public function findAll();

    /**
     * Finds a user by the given user ID.
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param $id
     *
     * @return \Cartalyst\Sentry\Users\UserInterface
     */
    public function findById($id);

    /**
     * Find a given user by the login attribute
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param $login
     *
     * @return \Cartalyst\Sentry\Users\UserInterface
     */
    public function findByLogin($login);

    /**
     * Logs the current user out.
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return void
     */
    public function logout();

    /**
     * Returns an empty user object.
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return \StdClass
     */
    public function getEmptyUser();

    /**
     * Returns the current user being used by Sentry, if any.
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return mixed|\Cartalyst\Sentry\Users\UserInterface
     */
    public function getUser();

    /**
     * Get the throttle provider for a given user
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param $id
     *
     * @return \Cartalyst\Sentry\Throttling\ThrottleInterface
     */
    public function getUserThrottle($id);

    /**
     *  Reset a given user password
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param $code
     * @param $password
     *
     * @return \Cartalyst\Sentry\Users\UserInterface
     */
    public function resetPassword($code,$password);

    /**
     * Update user information
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param       $id
     * @param array $attributes
     *
     * @return \Cartalyst\Sentry\Users\UserInterface
     */
    public function update($id, array $attributes);

    /**
     * Registers a user by giving the required credentials
     * and an optional flag for whether to activate the user.
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param array $credentials
     * @param bool  $activate
     *
     * @return \Cartalyst\Sentry\Users\UserInterface
     */
    public function register(array $credentials, $activate = false);

    /**
     * Update permissions for a given user
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param int   $id
     * @param array $permissions
     *
     * @return \Cartalyst\Sentry\Users\UserInterface
     */
    public function updatePermissions($id, array $permissions);

    /**
     *
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param $id
     * @param $status
     *
     * @throws \BadMethodCallException
     *
     * @return void
     */
    public function updateThrottleStatus($id, $status);

} 