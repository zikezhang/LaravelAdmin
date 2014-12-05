<?php  namespace Verecom\Admin\Group\Form; 

use Verecom\Admin\Services\Validation\ValidableInterface;
use Verecom\Admin\Group\Repo\AdminGroupInterface;
use Cartalyst\Sentry\Groups\NameRequiredException;
use Cartalyst\Sentry\Groups\GroupExistsException;

class GroupForm implements GroupFormInterface {


    /**
     * @var \Verecom\Admin\Services\Validation\ValidableInterface
     */
    protected  $validator;

    /**
     * @var \Verecom\Admin\Group\Repo\AdminGroupInterface
     */
    protected $groups;

    /**
     * @param ValidableInterface                              $validator
     * @param \Verecom\Admin\Group\Repo\AdminGroupInterface $groups
     */
    public function __construct(ValidableInterface $validator, AdminGroupInterface $groups)
    {
        $this->validator = $validator;
        $this->groups = $groups;
    }

    /**
     * Create a new Group
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data)
    {
        try
        {
            if ($this->validator->with($data)->passes())
            {
                $this->groups->create($data);
                return true;
            }
        }
        catch (GroupExistsException $e)
        {
            $this->validator->add('GroupExistsException', $e->getMessage());
        }
        catch (NameRequiredException $e)
        {
            $this->validator->add('NameRequiredException', $e->getMessage());
        }

        return false;
    }

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
    public function update(array $data)
    {
        try
        {
            if ($this->validator->with($data)->validForUpdate())
            {
                $this->groups->update($data);
                return true;
            }
        }
        catch (GroupExistsException $e)
        {
            $this->validator->add('GroupExistsException', $e->getMessage());
        }
        catch (NameRequiredException $e)
        {
            $this->validator->add('NameRequiredException', $e->getMessage());
        }

        return false;
    }

    /**
     * Get the validator error
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return \Illuminate\Support\MessageBag
     */
    public function getErrors()
    {
        return $this->validator->errors();
    }
}