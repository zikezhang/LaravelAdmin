<?php  namespace Verecom\Admin\Group\Form; 

use Verecom\Admin\Services\Validation\AbstractValidator;

class GroupValidator extends AbstractValidator {

    /**
     * Validation rules
     *
     * @var Array
     */
    protected $rules = array(
        'name' => 'required|unique:groups'
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
        $this->rules['name'] .= ',name,' . $this->data['id'];
        return parent::passes();
    }
} 