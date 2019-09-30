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

namespace Chance\CitrixRightSignature;

use Chance\CitrixRightSignature\Token\AccessTokenInterface;
use Chance\CitrixRightSignature\Token\OauthCodeRequest;

class Client implements CitrixRightSignatureClientInterface
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $guzzleClient;

    /**
     * @var AccessTokenInterface
     */
    private $accessToken;

    private $clientId;

    private $clientSecret;

    private $redirectUri;

    /**
     * @return \GuzzleHttp\Client
     */
    public function getGuzzleClient()
    {
        return $this->guzzleClient;
    }

    /**
     * @param \GuzzleHttp\Client $guzzleClient
     */
    public function setGuzzleClient(\GuzzleHttp\Client $guzzleClient)
    {
        $this->guzzleClient = $guzzleClient;
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
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
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
     * @param mixed $clientSecret
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
    }

    // https://api.rightsignature.com/documentation/resources

    // todo get auth token via GET /oauth/token

    public function getGrantRequestUri()
    {
        $grantRequest = OauthCodeRequest::createAuthRequest($this->clientId, $this->clientSecret, $this->redirectUri);

        $httpBuildQuery = http_build_query($grantRequest->getFormData('grant'));

        return self::BASE_URL . OauthCodeRequest::GRANT_ENDPOINT . '?' . $httpBuildQuery;

    }

    // todo request access token via POST /oauth/token

    /**
     * @param $code
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function requestAccessToken($code)
    {
        /**
         * curl -F grant_type=authorization_code \
        -F client_id=CLIENT_ID \
        -F client_secret=CLIENT_SECRET \
        -F code=AUTHORIZATION_CODE_FROM_REDIRECT \
        -F redirect_uri=REDIRECT_URI \
        -X POST https://api.rightsignature.com/oauth/token
         */
        $grantRequest = OauthCodeRequest::createAuthRequest($this->clientId, $this->clientSecret, $this->redirectUri);

        $grantRequest->setCode($code);

        $uri = self::BASE_URL . OauthCodeRequest::TOKEN_ENDPOINT;
        $formData = $grantRequest->getFormData('access');

        $a = 1;

        return $this->guzzleClient->post($uri, [
            'form_params' => $formData,
        ]);
    }

    // todo refresh access token

    // todo revoke token

    // https://api.rightsignature.com/documentation/resources/v1/sending_requests/create.en.html

    // todo create sending request (upload)

    // todo trigger RS document stuff via uploaded
}