<?php namespace Verecom\Admin\Group\Repo;

interface AdminGroupInterface {

    /**
     * Find the group by ID.
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param  int  $id
     * @return \Cartalyst\Sentry\Groups\GroupInterface  $group
     *
     * @throws \Cartalyst\Sentry\Groups\GroupNotFoundException
     */
    public function findById($id);

    /**
     * Find the group by name.
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param  string  $name
     * @return \Cartalyst\Sentry\Groups\GroupInterface  $group
     *
     * @throws \Cartalyst\Sentry\Groups\GroupNotFoundException
     */
    public function findByName($name);

    /**
     * Returns all groups.
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return array  $groups
     */
    public function findAll();

    /**
     * Creates a group.
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param  array  $attributes
     *
     * @return \Cartalyst\Sentry\Groups\GroupInterface
     */
    public function create(array $attributes);

    /**
     * Update a group
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param array $attributes
     *
     * @return bool
     */
    public function update(array $attributes);

    /**
     * Delete a group
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param $id
     *
     * @return void
     *
     * @throws \Cartalyst\Sentry\Groups\GroupNotFoundException
     */
    public function delete($id);

} 