<?php  namespace Verecom\Admin\User\Form; 

use Verecom\Admin\Services\Validation\AbstractValidator;

class PasswordValidator extends AbstractValidator {

    /**
     * Validation rules
     *
     * @var Array
     */
    protected $rules = array(
        'password'   => 'required|confirmed',
        'code'       => 'required'
    );
} 