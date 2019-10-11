<?php
/**
 * @package
 * @subpackage
 * @author      Chance Garcia <chance@garcia.codes>
 * @copyright   (C)Copyright 2013-2019 Chance Garcia, chancegarcia.com
 *
 *    The MIT License (MIT)
 *
 * Copyright (c) 2013-2019 Chance Garcia
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 */

namespace Chance\CitrixRightSignature\Token;

interface OauthCodeRequestInterface extends \JsonSerializable
{
    const GRANT_ENDPOINT = '/oauth/authorize';

    const TOKEN_ENDPOINT = '/oauth/token';

    const REVOKE_ENDPOINT = '/oauth/revoke';

    const VALID_GRANT_TYPES = [
        'access',
        'refresh',
    ];

    const GRANT_TYPES = [
        'access' => 'authorization_code',
        'refresh' => 'refresh_token',
    ];

    /**
     * @param string $type valid types are grant and refresh; default to grant
     * @return null|array
     */
    public function getFormData($type);

    /**
     * @return mixed
     */
    public function getClientId();

    /**
     * @param mixed $clientId
     */
    public function setClientId($clientId);

    /**
     * @return mixed
     */
    public function getClientSecret();

    /**
     * @param mixed $clientSecret
     */
    public function setClientSecret($clientSecret);

    /**
     * @return mixed
     */
    public function getRedirectUri();

    /**
     * @param mixed $redirectUri
     */
    public function setRedirectUri($redirectUri);

    /**
     * @return mixed
     */
    public function getCode();

    /**
     * @param $code
     */
    public function setCode($code);

    /**
     * @return mixed
     */
    public function getGrantType();

    /**
     * @param $grantType
     */
    public function setGrantType($grantType);

    /**
     * @return AccessTokenInterface
     */
    public function getAccessToken();

    /**
     * @param AccessTokenInterface $accessToken
     */
    public function setAccessToken(AccessTokenInterface $accessToken);

    /**
     * @return string
     */
    public function getScope();

    /**
     * @param string $scope
     */
    public function setScope($scope);
}