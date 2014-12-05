<?php namespace Verecom\Admin\Controllers;

use View, Redirect, Input, Lang, Config;
use Verecom\Admin\Group\Repo\adminGroupInterface;
use Verecom\Admin\Group\Form\GroupFormInterface;
use Verecom\Admin\Permission\Repo\PermissionInterface;
use Verecom\Admin\Group\Repo\GroupNotFoundException;

class GroupsController extends BaseController {

    /**
     * @var \Verecom\Admin\Group\Repo\adminGroupInterface
     */
    protected $groups;

    /**
     * @var \Verecom\Admin\Group\Form\GroupFormInterface
     */
    protected $form;

    /**
     * @var \Verecom\Admin\Permission\Repo\PermissionInterface
     */
    protected $permissions;

    /**
     * @param \Verecom\Admin\Group\Repo\adminGroupInterface     $groups
     * @param \Verecom\Admin\Group\Form\GroupFormInterface       $form
     * @param \Verecom\Admin\Permission\Repo\PermissionInterface $permissions
     */
    public function __construct(
        adminGroupInterface $groups,
        GroupFormInterface $form,
        PermissionInterface $permissions
    )
    {
        $this->groups = $groups;
        $this->form = $form;
        $this->permissions = $permissions;
    }


    /**
     * Display all the groups
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $groups = $this->groups->findAll();
        return View::make(Config::get('admin::views.groups_index'), compact('groups'));
    }

    /**
     * Display create a new group form
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $genericPermissions = $this->permissions->generic();
        $modulePermissions = $this->permissions->module();
        $groupPermissions = array();

        return View::make(Config::get('admin::views.groups_create'))
            ->with('genericPermissions',$genericPermissions)
            ->with('modulePermissions',$modulePermissions)
            ->with('groupPermissions',$groupPermissions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        try
        {
            $group = $this->groups->findById($id);

            $groupPermissions = $group->getPermissions();
            $genericPermissions = $this->permissions->generic();
            $modulePermissions = $this->permissions->module();


            return View::make(Config::get('admin::views.groups_edit'))
                ->with('group',$group)
                ->with('genericPermissions',$genericPermissions)
                ->with('modulePermissions',$modulePermissions)
                ->with('groupPermissions',$groupPermissions);
        }
        catch ( GroupNotFoundException $e)
        {
            return Redirect::route('admin.groups.index')->with('error', $e->getMessage());
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        if ( $this->form->create(Input::all()) )
        {
            return Redirect::route('admin.groups.index')
                ->with('success', Lang::get('admin::groups.create_success'));
        }

        return Redirect::back()
            ->withInput()
            ->withErrors($this->form->getErrors());
    }

    /**
     * Update the specified resource in storage.
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id)
    {
        try
        {
            $inputs = Input::all();
            $inputs['id'] = $id;

            if ( $this->form->update($inputs) )
            {
                return Redirect::route('admin.groups.index')
                    ->with('success', Lang::get('admin::groups.update_success') );
            }

            return Redirect::back()
                ->withInput()
                ->withErrors($this->form->getErrors());
        }
        catch (GroupNotFoundException $e)
        {
            return Redirect::route('admin.groups.index')
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @author ZZK
     * @link   http://verecom.com
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try
        {
            $this->groups->delete($id);

            return Redirect::route('admin.groups.index')
                ->with('success', Lang::get('admin::groups.delete_success'));
        }
        catch (GroupNotFoundException $e)
        {
            return Redirect::back()->with('error', $e->getMessage());
        }
    }

}
