<?php namespace Verecom\Admin\Permission\Repo;

interface PermissionInterface {

    /**
     * Grab all the permissions from storage
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param array $columns
     *
     * @return \StdClass
     */
    public function all($columns = array('*'));

    /**
     * Put into storage a new permission
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
     * Delete a permission from storage
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param $id
     *
     * @return bool
     */
    public function delete($id);

    /**
     *
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param       $id
     * @param array $columns
     *
     * @return null|\StdClass
     */
    public function find($id, $columns = array('*'));

    /**
     *
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param       $id
     * @param array $columns
     *
     * @throws PermissionNotFoundException
     *
     * @return mixed
     */
    public function findOrFail($id, $columns = array('*'));

    /**
     * Get the generic permissions
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return array
     */
    public function generic();

    /**
     * get the module permissions
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return array
     */
    public function module();

    /**
     * Update a permission into storage
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param array $data
     *
     * @return bool
     */
    public function update(array $data);

} 