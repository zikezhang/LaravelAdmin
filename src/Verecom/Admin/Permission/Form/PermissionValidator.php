<?php  namespace Verecom\Admin\Permission\Form;

use Verecom\Admin\Services\Validation\AbstractValidator;

class PermissionValidator extends AbstractValidator {

    /**
     * Validation rules
     *
     * @var Array
     */
    protected $rules = array(
        'name'        => 'required|unique:permissions',
        'permissions' => 'required'
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