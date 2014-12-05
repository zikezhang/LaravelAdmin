<?php namespace Verecom\Admin\Services\Validation;


interface ValidableInterface {

    /**
     * Add data to validation against
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param array $input
     * @return $this
     */
    public function with(array $input);

    /**
     * Test if validation passes
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return bool
     */
    public function passes();

    /**
     * Test if validation passes before create
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return bool
     */
    public function validForCreate();

    /**
     * Test if validation passes before update
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return bool
     */
    public function validForUpdate();

    /**
     * Retrieve validation errors
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return \Illuminate\Support\MessageBag
     */
    public function errors();

    /**
     * Add a message to the bag.
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param string $key
     * @param string $message
     * @return $this
     */
    public function add($key, $message);

    /**
     * Get the stored data
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return array
     */
    public function getData();
}