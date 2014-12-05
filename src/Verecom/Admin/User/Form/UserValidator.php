<?php  namespace Verecom\Admin\User\Form; 

use Verecom\Admin\Services\Validation\AbstractValidator;

class UserValidator extends AbstractValidator {

    /**
     * Validation rules
     *
     * @var Array
     */
    protected $rules = array(
        'first_name' => 'required',
        'last_name'  => 'required',
        'password'   => 'required|confirmed',
        'email'      => 'required|email'
    );

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
        if( empty($this->data['password']) AND empty($this->data['password_confirmation']) )
        {
            unset($this->rules['password']);
            unset($this->data['password']);
        }

        return parent::passes();
    }
} 