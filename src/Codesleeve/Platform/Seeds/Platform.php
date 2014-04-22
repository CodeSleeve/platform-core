<?php namespace Codesleeve\Platform\Seeds;

use DB, Hash, Seeder, Sentry, Exception;

class Platform extends Seeder
{
    /**
     * Run the platform seeder
     *
     */
    public function run()
    {
        $this->createGroup('Admin');
        $this->createUser('admin', 'password', 'Admin', 'User', 'Admin');
    }

    /**
     * Create a new user with the given attributes
     *
     */
    protected function createUser($email, $password, $firstName, $lastName, $role = null)
    {
        try
        {
            $user = Sentry::createUser([
                'email'     => $email,
                'password'  => $password,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'activated' => true,
            ]);

            if (!$role) return;

            $group = Sentry::findGroupByName($role);

            $user->addGroup($group);
        }
        catch(\Exception $e)
        {
            // this user probably already exists... so ignore the exception
        }
    }

    /**
     * Create roles if they don't exist already
     *
     */
    protected function createGroup($name)
    {
        try
        {
            $group = \Sentry::createGroup(
            [
                'name'        => $name,
                'permissions' => [
                    'superuser' => 1,
                ],
            ]);
        }
        catch (\Exception $e)
        {
            // this group probably already exists... so ignore the exception
        }
    }

}