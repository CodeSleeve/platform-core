<?php namespace Codesleeve\Platform\Controllers;

use Codesleeve\Platform\Models\User;
use Codesleeve\Platform\Models\Group;
use Codesleeve\Platform\Validators\UserValidator;

use View, Input, Auth, Session, Redirect, Response, App, Validator;

class UserController extends BaseController
{
	/**
	 * Create a new UserController
	 *
	 * @param User          $users
	 * @param UserValidator $validator
	 */
	public function __construct(User $users, Group $groups)
	{
		parent::__construct();

		$this->users = $users;
		$this->groups = $groups;
		$this->validator = new UserValidator($this->namespaced("UserController"));
	}

	/**
	 * View all of the users.
	 *
	 * @return void
	 */
	public function index()
	{
		$users = $this->users
			->orderBy(Input::query('sort_by', 'id'), Input::query('sort_direction', 'ASC'))
			->paginate();

		$this->layout->nest('content', "platform::users.index", compact('users'));
	}

	/**
	 * Show the form to create a new user.
	 *
	 * @return void
	 */
	public function create()
	{
		$user = $this->users->fill(Input::old());

		$user->available_groups = $this->groups->lists('name', 'id');

		$user->selected_groups = $user->groups()->select('groups.id AS id')->lists('id');

		$this->layout->nest('content', "platform::users.create", compact('user'));
	}

	/**
	 * Create a new user.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user = $this->users->fill(Input::all());

		$user->password = Input::get('password');

		$this->validator->validate(Input::all(), $user);

		$user->save();

		$user->groups()->sync(Input::get('group_ids'), []);

		Session::flash('success', 'Created user succesfully');

		return Redirect::action($this->namespaced("UserController@index"));
	}

	/**
	 * Show the user resource
	 *
	 * @param  int $id
	 * @return void
	 */
	public function show($id)
	{
		$user = $this->users->findOrFail($id);

		$this->layout->nest('content', "platform::users.show", compact('user'));
	}

	/**
	 * Show the form to edit a specific user.
	 *
	 * @param  int $id
	 * @return void
	 */
	public function edit($id)
	{
		$user = $this->users->findOrFail($id);

		$user->available_groups = $this->groups->lists('name', 'id');

		$user->selected_groups = $user->groups()->select('groups.id AS id')->lists('id');

		$this->layout->nest('content', "platform::users.edit", compact('user'));
	}

	/**
	 * Edit a specific user.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = $this->users->findOrFail($id);

		$user->fill(Input::all());

		if (Input::get('password'))
		{
			$user->password = Input::get('password');
		}

		$this->validator->validate(Input::all(), $user);

		$user->save();

		$user->groups()->sync(Input::get('group_ids', []));

		Session::flash('success', 'Updated user successfully');

		return Redirect::action($this->namespaced("UserController@index"));
	}

	/**
	 * Delete a specific user record.
	 *
	 * @param  int $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = $this->users->findOrFail($id);

		$user->delete();

		Session::flash('success', 'Record deletion successful!');

		return Redirect::action($this->namespaced("UserController@index"));
	}
}