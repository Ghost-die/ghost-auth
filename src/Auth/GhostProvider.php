<?php

namespace Ghost\GhostAuth\Auth;

use Exception;
use Illuminate\Support\Arr;

class GhostProvider extends AbstractProvider implements ProviderInterface
{
	/**
	 * The scopes being requested.
	 *
	 * @var array
	 */
	protected $scopes = ['user','email'];
	
	/**
	 * The separating character for the requested scopes.
	 *
	 * @var string
	 */
	protected $scopeSeparator = ' ';
	
	
	/**
	 * {@inheritdoc}
	 */
	protected function getAuthUrl($state)
	{
		return $this->buildAuthUrlFromBase('https://www.ghost-ai.com/oauth/authorize', $state);
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getTokenUrl()
	{
		return 'https://www.ghost-ai.com/oauth/token';
	}
	
	
	protected function getUserInfoUrl()
	{
		return 'https://www.ghost-ai.com/api/auth/user';
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getUserByToken($token)
	{
		$response = $this->getHttpClient()->post(
			$this->getUserInfoUrl(), $this->getRequestOptions($token)
		);
		return json_decode($response->getBody(), true);
	}
	
	/**
	 * Get the POST fields for the token request.
	 *
	 * @param  string  $code
	 * @return array
	 */
	protected function getTokenFields($code)
	{
		return [
			'grant_type' => 'authorization_code',
			'client_id' =>  $this->clientId,
			'client_secret' => $this->clientSecret,
			'redirect_uri' =>  $this->redirectUrl,
			'code' =>$code,
		];
	}
	
	
	/**
	 * {@inheritdoc}
	 */
	protected function mapUserToObject(array $user)
	{
		return (new User)->setRaw($user)->map([
			'id' => $user['id'],
			'name' => Arr::get($user, 'name'),
			'email' => Arr::get($user, 'email'),
			'avatar' => $user['avatar'],
		]);
	}
	
	/**
	 * Get the default options for an HTTP request.
	 *
	 * @param $token
	 * @return array
	 */
	protected function getRequestOptions($token)
	{
		return [
			'headers' => [
				'X-Requested-With' => 'XMLHttpRequest',
				'Accept' => 'application/json',
				'Authorization' => 'Bearer '.$token
			],
		];
	}
}
