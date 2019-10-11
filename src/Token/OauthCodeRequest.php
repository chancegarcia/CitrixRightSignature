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

// https://api.rightsignature.com/documentation/resources/v1/oauth_authorizations/default_url_options.en.html

class OauthCodeRequest implements OauthCodeRequestInterface
{
    private $clientId;

    private $clientSecret;

    /**
     * @var string Where the user-agent will be redirected to after an authorization code is granted. Note that this MUST match what is on record with the API Key associated with the passed in client id
     */
    private $redirectUri;

    private $code;

    /**
     * @var string valid types are: 'access', 'refresh'
     */
    private $grantType = 'access';

    /**
     * @var AccessTokenInterface
     */
    private $accessToken;

    private $scope = 'read write';

    private $responseType = 'code';

    /**
     * @return OauthCodeRequestInterface
     */
    public static function generateNewInstance()
    {
        return new static();
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        // maybe get fancy in the future and use inflector (https://github.com/doctrine/inflector) with reflection to create the array.
        return [
            'grant_type' => self::GRANT_TYPES[$this->grantType],
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'redirect_uri' => $this->redirectUri,
            'code' => $this->code,
            'scope' => $this->scope,
            'response_type' => $this->responseType,
        ];
    }

    /**
     * @param string $type valid types are auth, access and refresh; default to access
     * @return null|array
     */
    public function getFormData($type)
    {
        switch ($type) {
            case 'refresh':
                $formDataArray = $this->jsonSerialize();
                if (is_array($formDataArray)) {
                    unset($formDataArray['code'], $formDataArray['redirect_uri'], $formDataArray['scope'], $formDataArray['response_type']);
                    if ($this->accessToken instanceof AccessTokenInterface) {
                        $formDataArray['refresh_token'] = $this->accessToken->getRefreshToken();
                    }
                }
                break;
            case 'access':
                $formDataArray = $this->jsonSerialize();
                if (is_array($formDataArray)) {
                    unset($formDataArray['scope'], $formDataArray['response_type']);
                }
                break;
            case 'auth':
                // no break
                $formDataArray = $this->jsonSerialize();
                unset($formDataArray['code'], $formDataArray['grant_type'], $formDataArray['client_secret']);
                break;
            default:
                $formDataArray = $this->jsonSerialize();
                break;
        }

        return $formDataArray;
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param mixed $clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * @return mixed
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * @param mixed $clientSecret
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
    }

    /**
     * @return mixed
     */
    public function getRedirectUri()
    {
        return $this->redirectUri;
    }

    /**
     * @param mixed $redirectUri
     */
    public function setRedirectUri($redirectUri)
    {
        $this->redirectUri = $redirectUri;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getGrantType()
    {
        return $this->grantType;
    }

    /**
     * @param mixed $grantType
     */
    public function setGrantType($grantType)
    {
        if (in_array($grantType, self::VALID_GRANT_TYPES)) {
            $this->grantType = $grantType;
        }
    }

    /**
     * @return AccessTokenInterface
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param AccessTokenInterface $accessToken
     */
    public function setAccessToken(AccessTokenInterface $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return string
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * @param string $scope
     */
    public function setScope($scope)
    {
        $this->scope = $scope;
    }

    /**
     * @param string $clientId
     * @param string $clientSecret
     * @param string $redirectUri
     * @return OauthCodeRequestInterface
     */
    public static function createAuthRequest($clientId, $clientSecret, $redirectUri)
    {
        $request = static::generateNewInstance();
        $request->setClientId($clientId);
        $request->setClientSecret($clientSecret);
        $request->setRedirectUri($redirectUri);

        return $request;
    }

    public static function createAccessRequest($clientId, $clientSecret, $redirectUri, $code)
    {
        $request = static::generateNewInstance();
        $request->setClientId($clientId);
        $request->setClientSecret($clientSecret);
        $request->setRedirectUri($redirectUri);
        $request->setCode($code);
    }

    /**
     * @param $clientId
     * @param $clientSecret
     * @param AccessTokenInterface|null $accessToken
     * @return OauthCodeRequestInterface
     */
    public static function createRefreshRequest($clientId, $clientSecret, AccessTokenInterface $accessToken = null)
    {
        $request = self::generateNewInstance();
        $request->setClientId($clientId);
        $request->setClientSecret($clientSecret);
        if ($accessToken instanceof AccessTokenInterface) {
            $request->setAccessToken($accessToken);
        }

        return $request;
    }
}