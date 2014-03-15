<?php namespace Codesleeve\Platform\Models;

use Eloquent;

class Role extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'roles';

	/**
	 * The fillable array lets laravel know which fields are fillable
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'alias'];

	/**
	 * A role belongs to many users
	 *
	 * @return belongsToMany
	 */
    public function users()
    {
        return $this->belongsToMany('Codesleeve\Platform\Models\User', 'roles_users');
    }
}

