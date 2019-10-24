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

namespace Chance\CitrixRightSignature\Document;

interface RecipientInterface extends \JsonSerializable
{
    /**
     * @return mixed
     */
    public function getRoleName();

    /**
     * @param mixed $roleName
     */
    public function setRoleName($roleName);

    /**
     * @return mixed
     */
    public function getName();

    /**
     * @param mixed $name
     */
    public function setName($name);

    /**
     * @return mixed
     */
    public function getEmail();

    /**
     * @param mixed $email
     */
    public function setEmail($email);

    /**
     * @return mixed
     */
    public function getStatus();

    /**
     * @param mixed $status
     */
    public function setStatus($status);

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @param mixed $id
     */
    public function setId($id);

    /**
     * @return mixed
     */
    public function getSignUri();

    /**
     * @param mixed $signUri
     */
    public function setSignUri($signUri);

    /**
     * @return mixed
     */
    public function getRemindUri();

    /**
     * @param mixed $remindUri
     */
    public function setRemindUri($remindUri);

    /**
     * @return mixed
     */
    public function getMessage();

    /**
     * @param mixed $message
     */
    public function setMessage($message);

    /**
     * @return mixed
     */
    public function getSequence();

    /**
     * @param mixed $sequence
     */
    public function setSequence($sequence);
}