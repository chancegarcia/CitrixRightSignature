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

class Recipient implements RecipientInterface
{
    private $roleName;

    private $name;

    private $email;

    private $status;

    private $id;

    private $signUri;

    private $remindUri;

    private $message;

    private $sequence;

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        /*
     * "role_name": "signer2",
        "name": "Susie Orange",
        "email": "susie@citrix.com",
        "status": "pending",
        "id": "c76fad94-749b-495b-b088-c184282072e4",
        "sign_url": "https://secure.rs.dev:3000/signers/c76fad94-749b-495b-b088-c184282072e4/sign?access_token=GyBD2At_UrapgeDkyccx",
        "remind_url": "https://api.rs.dev:3002/public/v1/signers/c76fad94-749b-495b-b088-c184282072e4/reminders",
        "message": "Please sign.",
        "sequence": 1
     */

        return [
            'role_name' => $this->roleName,
            'name' => $this->name,
            'email' => $this->email,
            'status' => $this->status,
            'id' => $this->id,
            'sign_url' => $this->signUri,
            'remind_url' => $this->remindUri,
            'message' => $this->message,
            'sequence' => $this->sequence,
        ];

        // TODO: Implement jsonSerialize() method.
    }

    /**
     * @return mixed
     */
    public function getRoleName()
    {
        return $this->roleName;
    }

    /**
     * @param mixed $roleName
     */
    public function setRoleName($roleName)
    {
        $this->roleName = $roleName;
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
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getSignUri()
    {
        return $this->signUri;
    }

    /**
     * @param mixed $signUri
     */
    public function setSignUri($signUri)
    {
        $this->signUri = $signUri;
    }

    /**
     * @return mixed
     */
    public function getRemindUri()
    {
        return $this->remindUri;
    }

    /**
     * @param mixed $remindUri
     */
    public function setRemindUri($remindUri)
    {
        $this->remindUri = $remindUri;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getSequence()
    {
        return $this->sequence;
    }

    /**
     * @param mixed $sequence
     */
    public function setSequence($sequence)
    {
        $this->sequence = $sequence;
    }
}