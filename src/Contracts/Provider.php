<?php

namespace Ghost\GhostAuth\Contracts;

use Symfony\Component\HttpFoundation\RedirectResponse;

interface Provider
{
    /**
     * Redirect the user to the authentication page for the provider.
     *
     * @return RedirectResponse
     */
    public function redirect();

    /**
     * Get the User instance for the authenticated user.
     *
     * @return User
     */
    public function user();
}
