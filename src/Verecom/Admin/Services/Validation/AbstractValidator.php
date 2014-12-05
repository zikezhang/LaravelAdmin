<?php namespace Verecom\Admin\Services\Validation;

use Illuminate\Validation\Factory;
use Illuminate\Support\MessageBag;

class AbstractValidator implements ValidableInterface {

    /**
     * Validator
     *
     * @var \Illuminate\Validation\Factory
     */
    protected $validator;

    /**
     * @var \Illuminate\Support\MessageBag
     */
    protected $errors;

    /**
     * Validation data key => value array
     *
     * @var Array
     */
    protected $data = array();

    /**
     * Validation rules
     *
     * @var Array
     */
    protected $rules = array();

    /**
     * Custom error messages
     *
     * @var Array
     */
    protected $messages = array();

    /**
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param Factory $validator
     * @param \Illuminate\Support\MessageBag $errors
     */
    function __construct(Factory $validator, MessageBag $errors)
    {
        $this->validator = $validator;
        $this->errors = $errors;
    }


    /**
     * Add data to validation against
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param array $data
     * @return $this
     */
    public function with(array $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Test if validation passes
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return bool
     */
    public function passes()
    {
        $validator = $this->validator->make($this->data, $this->rules, $this->messages);

        if( $validator->fails() )
        {
            $this->errors = $validator->messages();
            return false;
        }

        return true;
    }

    /**
     * Test if validation passes before create
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return bool
     */
    public function validForCreate()
    {
        return $this->passes();
    }

    /**
     * Test if validation passes before update
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return bool
     */
    public function validForUpdate()
    {
        return $this->passes();
    }

    /**
     * Retrieve validation errors
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return \Illuminate\Support\MessageBag
     */
    public function errors()
    {
        return $this->errors;
    }

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
    public function add($key, $message)
    {
        $this->errors->add($key, $message);
        return $this;
    }

    /**
     * Get the stored data
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}