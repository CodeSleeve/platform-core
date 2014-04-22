<?php namespace Codesleeve\Platform\Models;

use Hash, Eloquent, Sentry;

class Group extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'groups';

	/**
	 * The allowed fields to fill this array with
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'permissions',
	];

	/**
	 * Create a new group via Sentry
	 *
	 * @param  array $input
	 * @return Sentry::Group
	 */
	public function createNewGroup($input)
	{
		return Sentry::createGroup([
			'name' => $input['name'],
			'permissions' => $this->getPermissionsFromInput($input),
		]);
	}

	/**
	 * Updates this group with the input given
	 *
	 * @param  array $input
	 * @return Sentry::group
	 */
	public function updateGroup($input)
	{
	    $this->name = $input['name'];
		$this->permissions = $this->getPermissionsFromInput($input);
		$this->save();
	}

	/**
	 * Get a list of permissions for this group
	 *
	 * @return array
	 */
	public function getPermissionsAttribute()
	{
		if (!$this->attributes['permissions']) return array();

		$data = json_decode($this->attributes['permissions']);

		return $data;
	}

	/**
	 * Get a list of permissions for this group
	 *
	 * @return array
	 */
	public function setPermissionsAttribute($permissions)
	{
		$this->attributes['permissions'] = json_encode($permissions);
	}

	/**
	 * Filter the list of permissions from the given input
	 *
	 * @param  array $input
	 * @return array
	 */
	private function getPermissionsFromInput($input)
	{
		$permissions = [];
		$unfiltered = array_key_exists('permissions', $input) ? $input['permissions'] : [];

		foreach ($unfiltered as $permission)
		{
			$permissions[$permission] = 1;
		}

		return $permissions;
	}
}