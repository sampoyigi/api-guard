<?php

namespace Chrisbjr\ApiGuard\Providers\Auth;

use October\Rain\Auth\Manager as OctoberAuth;

class October implements \Chrisbjr\ApiGuard\Contracts\Providers\Auth
{

    /**
     * @var \October\Rain\Auth\Manager
     */
    protected $october;

    /**
     * @param  \October\Rain\Auth\Manager $october
     */
    public function __construct(OctoberAuth $october)
    {
        $this->october = $october;
    }

    /**
     * Check a user's credentials.
     *
     * @param  array $credentials
     *
     * @return mixed
     */
    public function byCredentials(array $credentials)
    {
        return $this->october->findUserByCredentials($credentials);
    }

    /**
     * Authenticate a user via the id.
     *
     * @param  mixed $id
     *
     * @return bool
     */
    public function byId($id)
    {
        if ( ! is_null($user = $this->october->findUserById($id))) {
            $this->october->setUser($user);

            return true;
        }

        return false;
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \October\Rain\Auth\Models\User
     */
    public function user()
    {
        return $this->october->getUser();
    }

}