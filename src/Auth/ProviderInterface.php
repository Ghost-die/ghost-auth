<?php

namespace Ghost\GhostAuth\Auth;

use Symfony\Component\HttpFoundation\RedirectResponse;

interface ProviderInterface
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
	 * @return mixed
	 */
    public function user();
}
