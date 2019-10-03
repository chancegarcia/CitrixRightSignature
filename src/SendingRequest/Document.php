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

namespace Chance\CitrixRightSignature\SendingRequest;

// // https://api.rightsignature.com/documentation/resources/v1/sending_requests/create.en.html

class Document implements DocumentInterface
{
    private $signerSequencing = false;

    private $expiresIn = 5;

    private $name;

    /**
     * @var \Chance\CitrixRightSignature\SendingRequest\RoleInterface[]
     */
    private $roles = [];

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
            'signer_sequencing' => $this->signerSequencing,
            'expires_in' => $this->expiresIn,
            'name' => $this->name,
            'roles' => json_encode($this->roles),
        ];
    }

    /**
     * @return bool
     */
    public function isSignerSequencing()
    {
        return $this->signerSequencing;
    }

    /**
     * @param bool $signerSequencing
     */
    public function setSignerSequencing($signerSequencing)
    {
        $this->signerSequencing = $signerSequencing;
    }

    /**
     * @return int
     */
    public function getExpiresIn()
    {
        return $this->expiresIn;
    }

    /**
     * @param int $expiresIn
     */
    public function setExpiresIn($expiresIn)
    {
        $this->expiresIn = $expiresIn;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return RoleInterface[]
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param RoleInterface[] $roles
     */
    public function setRoles(array $roles)
    {
        // todo validate roles
        $this->roles = $roles;
    }

    /**
     * @return DocumentInterface
     */
    public static function generateNewInstance()
    {
        return new static();
    }

    /**
     * @param $name
     * @param array $roles
     * @return DocumentInterface
     */
    public static function createNewDocument($name, array $roles)
    {
        $doc = static::generateNewInstance();
        $doc->setName($name);
        $doc->setRoles($roles);

        return $doc;
    }
}