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

namespace Chance\CitrixRightSignature\Options;

use Chance\CitrixRightSignature\Exception\OptionsException;

class UploadedRequestOptions implements UploadedRequestOptionsInterface, \JsonSerializable
{
    private $prepareDocument = true;

    /**
     * @return false|string
     * @throws OptionsException
     */
    public function __toString()
    {
        $arr = $this->jsonSerialize();

        $str = \json_encode($arr);

        if (is_string($str)) {
            return $str;
        }

        throw new OptionsException('failed to convert jsonSerialize() return into string. Please check the jsonSerialize() method.');
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return [
            'prepare_document' => ($this->prepareDocument),
        ];
    }

    /**
     * @return bool
     */
    public function isPrepareDocument()
    {
        return $this->prepareDocument;
    }

    /**
     * @param bool $prepareDocument
     * @throws OptionsException
     */
    public function setPrepareDocument($prepareDocument)
    {
        $filterVar = filter_var($prepareDocument, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        if (is_bool($filterVar)) {
            $this->prepareDocument = $prepareDocument;
        } else {
            throw new OptionsException(sprintf('value must be a valid boolean. Got: %s', (string) $prepareDocument), OptionsException::UNEXPECTED_VALUE);
        }

    }

    /**
     * @param bool $prepareDocument
     * @return UploadedRequestOptions
     */
    public static function createNew($prepareDocument = true)
    {
        $options = new static();
        $options->setPrepareDocument($prepareDocument);

        return $options;
    }
}