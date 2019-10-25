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

use Chance\CitrixRightSignature\Exception\ClientException;
use Chance\CitrixRightSignature\Token\AccessToken;
use Chance\CitrixRightSignature\Token\AccessTokenInterface;
use Chance\CitrixRightSignature\Token\OauthCodeRequest;
use Symfony\Component\HttpFoundation\Response;

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

    /**
     * @return string
     * @throws ClientException
     */
    public function getAuthCodeRequestUri()
    {
        $this->validateClientGrantState();

        $grantRequest = OauthCodeRequest::createAuthRequest($this->clientId, $this->clientSecret, $this->redirectUri);

        $httpBuildQuery = http_build_query($grantRequest->getFormData('auth'));

        return self::BASE_URL . OauthCodeRequest::GRANT_ENDPOINT . '?' . $httpBuildQuery;
    }

    /**
     * @return string uri to redirect to request a auth code
     * @throws ClientException
     */
    public function getGrantRequestUri()
    {
        $this->validateClientGrantState();

        $grantRequest = OauthCodeRequest::createAuthRequest($this->clientId, $this->clientSecret, $this->redirectUri);

        $httpBuildQuery = http_build_query($grantRequest->getFormData('grant'));

        return self::BASE_URL . OauthCodeRequest::GRANT_ENDPOINT . '?' . $httpBuildQuery;

    }

    /**
     * using a auth code, make a request to get an access token
     *
     * @param $code
     * @return \Psr\Http\Message\ResponseInterface
     * @throws ClientException
     */
    public function requestAccessToken($code)
    {
        $this->validateClientGrantState();
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

        $uri = $this->getFullTokenUri();
        $formData = $grantRequest->getFormData('access');

        return $this->guzzleClient->post($uri, [
            'json' => $formData,
        ]);
    }

    /**
     * @param AccessTokenInterface $accessToken
     * @return \Psr\Http\Message\ResponseInterface
     * @throws ClientException
     */
    public function requestRefreshToken(AccessTokenInterface $accessToken)
    {
        $this->validateClientBaseState();

        $uri = $this->getFullTokenUri();

        $refreshRequest = OauthCodeRequest::createRefreshRequest($this->clientId, $this->clientSecret, $accessToken);
        $refreshRequest->setGrantType('refresh');

        $formData = $refreshRequest->getFormData('refresh');

        return $this->guzzleClient->post($uri, [
            'json' => $formData,
        ]);
    }

    /**
     * convenience function to request a refreshed access token, set the returned token to the client and return the token for any further manipulation
     *
     * @return AccessTokenInterface
     * @throws ClientException
     */
    public function refreshAccessToken()
    {
        $this->validateClientAccessState();

        $response = $this->requestRefreshToken($this->accessToken);

        switch ($response->getStatusCode()) {
            case Response::HTTP_FORBIDDEN:
                break;
            case Response::HTTP_OK:
                $body = $response->getBody();
                $responseArray = json_decode($body, true);
                $accessToken = AccessToken::createFromApiResponse($responseArray);
                $this->accessToken = $accessToken;
                return $accessToken;
                break;
            default:
                throw ClientException::createUnexpectedStatusCodeException($response);
                break;
        }
    }

    /**
     * @return string
     */
    public function getFullTokenUri()
    {
        return self::BASE_URL . OauthCodeRequest::TOKEN_ENDPOINT;
    }

    /**
     * @return string
     */
    public function getFullRevokeTokenUri()
    {
        return self::BASE_URL . OauthCodeRequest::REVOKE_ENDPOINT;
    }

    // todo revoke token

    /**
     * @param AccessTokenInterface $accessToken
     * @return \Psr\Http\Message\ResponseInterface
     * @throws ClientException
     */
    public function requestRevokeToken(AccessTokenInterface $accessToken)
    {
        $this->validateClientBaseState();

        $uri = $this->getFullRevokeTokenUri();

        return $this->guzzleClient->post($uri, [
            'json' => [
                'token' => $accessToken->getAccessToken(),
            ],
            'auth' => [
                $this->clientId,
                $this->clientSecret,
            ],
        ]);
    }

    /**
     * @return bool
     * @throws ClientException
     */
    public function revokeAccessToken()
    {
        $this->validateClientAccessState();

        $response = $this->requestRevokeToken($this->accessToken);

        switch ($response->getStatusCode()) {
            case Response::HTTP_FORBIDDEN:
                throw ClientException::createUnauthorizedException($response);
                break;
            case Response::HTTP_OK:
                $this->accessToken = null;
                return true;
                break;
            default:
                throw ClientException::createUnexpectedStatusCodeException($response);
                break;
        }
    }

    /**
     * @return bool
     * @throws ClientException
     */
    public function validateClientAccessState()
    {
        $this->validateClientBaseState();

        if (!$this->accessToken instanceof AccessTokenInterface) {
            throw ClientException::createMissingAccessTokenException();
        }

        return true;
    }

    /**
     * @return bool
     * @throws ClientException
     */
    public function validateClientBaseState()
    {
        if (!is_string($this->clientId)) {
            throw ClientException::createMissingClientIdException();
        }

        if (!is_string($this->clientSecret)) {
            throw ClientException::createMissingClientSecretException();
        }

        return true;
    }

    /**
     * @return bool
     * @throws ClientException
     */
    public function validateClientGrantState()
    {
        $this->validateClientBaseState();

        if (!is_string($this->redirectUri)) {
            throw ClientException::createMissingRedirectException();
        }

        return true;
    }

    // https://api.rightsignature.com/documentation/resources/v1/sending_requests/create.en.html

    // todo create sending request (upload)

    /**
     * @param OneOffDocumentRequestInterface $oneOffDocumentRequest
     * @return \Psr\Http\Message\ResponseInterface
     * @throws ClientException
     * @throws \GuzzleHttp\Exception\ClientException
     */
    public function requestUploadUri(OneOffDocumentRequestInterface $oneOffDocumentRequest)
    {
        $this->validateClientAccessState();

        $uri = self::BASE_URL . OneOffDocumentRequest::BASE_ENDPOINT;
        $formData = $oneOffDocumentRequest->jsonSerialize();

        // json seems to work so access_token doesn't need to be sent as form_params
        $formData['access_token'] = $this->accessToken->getAccessToken();

        return $this->guzzleClient->post($uri, [
            'json' => $formData,
        ]);
    }

    /**
     * @param SendingRequestInterface $sendingRequest
     * @param $filePath
     * @return \Psr\Http\Message\ResponseInterface
     * @throws ClientException
     * @throws \GuzzleHttp\Exception\ClientException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function requestUpload(SendingRequestInterface $sendingRequest, $filePath)
    {
        $this->validateClientAccessState();
        $this->validateFile($filePath);

        // PUT the file into sendingRequest's uploadUri value
        $uri = $sendingRequest->getUploadUrl();

        // upload is to amazon and they have a key/sig already in the uploadUri so no access key needs to be sent with this request

        // using mult-part form doesn't work but according to google, this will achieve the same thing as we want to do with curl commands.
        // https://stackoverflow.com/questions/52005604/rewrite-curl-with-guzzle-file-upload-php

        // todo get mime-type for filepath
        $mimeType = mime_content_type($filePath);

        return $this->guzzleClient->request('PUT', $uri, [
            'body' => file_get_contents($filePath),
            'headers' => [
                'Content-Type' => mime_content_type($filePath),
            ]
        ]);
    }

    /**
     * @param $filePath
     * @return bool
     * @throws ClientException
     */
    public function validateFile($filePath)
    {
        if (!is_file($filePath)) {
            throw ClientException::createFileNotFoundException($filePath);
        }

        return true;
    }

    // todo trigger RS document stuff via uploaded

    /**
     * @param SendingRequestInterface $sendingRequest
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function requestUploadedRequest(SendingRequestInterface $sendingRequest)
    {
        $uriPath = str_replace(':id', $sendingRequest->getId(), OneOffDocumentRequest::UPLOADED_ENDPOINT);

        $uri = self::BASE_URL . $uriPath;

        return $this->guzzleClient->post($uri, [
            'form_params' => [
                'access_token' => $this->accessToken->getAccessToken(),
            ],
        ]);
    }

    /**
     * @param OneOffDocumentRequestInterface $oneOffDocumentRequest
     * @param $filePath
     * @return \Psr\Http\Message\ResponseInterface
     * @throws ClientException
     * @throws \GuzzleHttp\Exception\ClientException
     */
    public function upload(OneOffDocumentRequestInterface $oneOffDocumentRequest, $filePath)
    {
        $uploadRequestResponse = $this->requestUploadUri($oneOffDocumentRequest);

        switch (($uploadRequestResponse->getStatusCode())) {
            case Response::HTTP_BAD_REQUEST:
                // todo throw exception
                break;
            case Response::HTTP_UNAUTHORIZED:
                // todo throw exception
                break;
            case Response::HTTP_UNPROCESSABLE_ENTITY:
                // todo throw exception
                break;
            case Response::HTTP_NOT_FOUND:
                // todo throw exception
                break;
            case Response::HTTP_OK:
                // no break
            default:
                $body = $uploadRequestResponse->getBody();
                $aSendingRequest = json_decode($body, true);

                // see https://api.rightsignature.com/documentation/resources/v1/sending_requests/create.en.html
                $sendingRequest = SendingRequest::createFromApiResponse($aSendingRequest['sending_request']);

                // request uploaded triger using sending request response
                $putFileResponse = $this->requestUpload($sendingRequest, $filePath);
                // todo handle put file response
                switch ($putFileResponse->getStatusCode()) {
                    case Response::HTTP_OK:
                        // no break
                    default:
                        $body = $putFileResponse->getBody();
                        $contents = $body->getContents();
                    break;
                }

                // finally, trigger the uploaded stuff as documented by API resources
                return $this->requestUploadedRequest($sendingRequest);
                break;
        }
    }
}