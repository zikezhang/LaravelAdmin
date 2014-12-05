<?php namespace Verecom\Admin\Group\Form;

interface GroupFormInterface {

    /**
     * Create a new Group
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param array $data
     *
     * @return Bool
     */
    public function create(array $data);

    /**
     * Update a group
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param array $data
     *
     * @return Bool
     */
    public function update(array $data);

    /**
     * Get the validator error
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return \Illuminate\Support\MessageBag
     */
    public function getErrors();

} 