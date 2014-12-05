<?php namespace Verecom\Admin\Permission\Form;

interface PermissionFormInterface {

    /**
     * Create a new set of permissions
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
     * Update a current set of permissions
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param array $data
     *
     * @return \StdClass
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