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

namespace Chance\CitrixRightSignature\Exception;

use Psr\Http\Message\ResponseInterface;

class ClientException extends \Exception
{
    const UNEXPECTED_STATUS_CODE = 1;

    const MISSING_CLIENT_ID = 2;
    const MISSING_CLIENT_SECRET = 3;
    const MISSING_ACCESS_TOKEN = 4;
    const MISSING_REDIRECT_URI = 5;

    const UNAUTHORIZED = 6;

    const FILE_NOT_FOUND = 7;

    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param ResponseInterface $response
     */
    public function setResponse(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * @param ResponseInterface $response
     * @param \Throwable|null $previous
     * @return ClientException
     */
    public static function createUnexpectedStatusCodeException(ResponseInterface $response, \Throwable $previous = null)
    {
        $msg = sprintf('unexpected status code (%d) with body: %s', $response->getStatusCode(), $response->getBody());

        $usce = new static($msg, self::UNEXPECTED_STATUS_CODE, $previous);
        $usce->setResponse($response);

        return $usce;
    }

    /**
     * @param ResponseInterface $response
     * @param \Throwable|null $previous
     * @return ClientException
     */
    public static function createUnauthorizedException(ResponseInterface $response, \Throwable $previous = null)
    {
        $msg = sprintf('requested action is forbidden (OAuth2 Error); please access the response property of this exception for more details.');

        $usce = new static($msg, self::UNEXPECTED_STATUS_CODE, $previous);
        $usce->setResponse($response);

        return $usce;
    }

    public static function createMissingClientIdException(\Throwable $previous = null)
    {
        $msg = sprintf('clientId value must be set in order to use this client');

        return new static($msg, self::MISSING_CLIENT_ID, $previous);
    }

    public static function createMissingClientSecretException(\Throwable $previous = null)
    {
        $msg = sprintf('clientSecret value must be set in order to use this client');

        return new static($msg, self::MISSING_CLIENT_SECRET, $previous);
    }

    public static function createMissingAccessTokenException(\Throwable $previous = null)
    {
        $msg = sprintf('accessToken value must be set in order to use this client');

        return new static($msg, self::MISSING_ACCESS_TOKEN, $previous);
    }

    public static function createMissingRedirectException(\Throwable $previous = null)
    {
        $msg = sprintf('redirectUri value must be set in order to use this client');

        return new static($msg, self::MISSING_REDIRECT_URI, $previous);
    }

    public static function createFileNotFoundException($filePath, \Throwable $previous = null)
    {
        $msg = sprintf('unable to find file (%s)', $filePath);

        return new static($msg, self::FILE_NOT_FOUND, $previous);
    }
}