<?php namespace Codesleeve\Platform\Controllers;

use Codesleeve\Platform\Models\Group;
use Codesleeve\Platform\Validators\GroupValidator;

use View, Input, Auth, Session, Redirect, Response, App, Validator;

class GroupController extends BaseController
{
	/**
	 * Create a new GroupController
	 *
	 */
	public function __construct(Group $groups)
	{
		parent::__construct();

		$this->groups = $groups;
	}

	/**
	 * View all of the Groups.
	 *
	 * @return void
	 */
	public function index()
	{
		$groups = $this->groups
			->orderBy(Input::query('sort_by', 'id'), Input::query('sort_direction', 'ASC'))
			->paginate();

		$this->layout->nest('content', 'platform::groups.index', compact('groups'));
	}

	/**
	 * Show the form to create a new Group.
	 *
	 * @return void
	 */
	public function create()
	{
		$group = $this->groups->fill(Input::old());

		$this->layout->nest('content', "platform::groups.create", compact('group'));
	}

	/**
	 * Create a new Group.
	 *
	 * @return Redirect
	 */
	public function store()
	{
		$this->groups->createNewGroup(Input::all());

		Session::flash('success', 'Created Group succesfully');

		return Redirect::action($this->namespaced("GroupController@index"));
	}

	/**
	 * Show the Group
	 *
	 * @param  int $id
	 * @return void
	 */
	public function show($id)
	{
		$group = $this->groups->findOrFail($id);

		$this->layout->nest('content', "platform::groups.show", compact('group'));
	}

	/**
	 * Show the form to edit a specific Group.
	 *
	 * @param  int $id
	 * @return void
	 */
	public function edit($id)
	{
		$group = $this->groups->findOrFail($id);

		$this->layout->nest('content', "platform::groups.edit", compact('group'));
	}

	/**
	 * Edit a specific Group.
	 *
	 * @param  int $id
	 * @return Redirect
	 */
	public function update($id)
	{
		$group = $this->groups->findOrFail($id);

		$group->updateGroup(Input::all());

		Session::flash('success', 'Updated Group successfully');

		return Redirect::action($this->namespaced("GroupController@index"));
	}

	/**
	 * Delete a specific Group record.
	 *
	 * @param  int $id
	 * @return Redirect
	 */
	public function destroy($id)
	{
		$group = $this->groups->findOrFail($id);

		$group->delete();

		Session::flash('success', 'Record deletion successful!');

		return Redirect::action($this->namespaced("GroupController@index"));
	}
}