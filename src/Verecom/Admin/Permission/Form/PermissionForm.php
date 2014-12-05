<?php  namespace Verecom\Admin\Permission\Form;

use Verecom\Admin\Services\Validation\ValidableInterface;
use Verecom\Admin\Permission\Repo\PermissionInterface;

class PermissionForm implements PermissionFormInterface {

    /**
     * @var ValidableInterface
     */
    protected $validator;

    /**
     * @var PermissionInterface
     */
    protected $permission;

    /**
     * @param ValidableInterface      $validator
     * @param PermissionInterface $permission
     */
    public function __construct(ValidableInterface $validator, PermissionInterface $permission)
    {
        $this->validator = $validator;
        $this->permission = $permission;
    }

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
    public function create(array $data)
    {
        if ( $this->validator->with($data)->passes() )
        {
            $data['permissions'] = explode(',', $data['permissions']);
            $this->permission->create($data);
            return true;
        }
        else
        {
            return false;
        }
    }

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
    public function update(array $data)
    {
        if ( $this->validator->with($data)->validForUpdate() )
        {
            $data['permissions'] = explode(',', $data['permissions']);
            $this->permission->update($data);
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Get the validation errors
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return array|\Illuminate\Support\MessageBag
     */
    public function getErrors()
    {
        return $this->validator->errors();
    }
}