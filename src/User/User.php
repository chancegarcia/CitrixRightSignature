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

namespace Chance\CitrixRightSignature\User;

use Chance\CitrixRightSignature\Person;

class User extends Person implements UserInterface
{
    private $id;

    private $timezone;

    private $company;

    private $avatarUri;

    private $canSendDocuments = true;

    private $isGracePeriod = false;

    private $cancellationDate;

    public function jsonSerialize()
    {
        $base = parent::jsonSerialize();

        $user = [
            'id' => $this->id,
            'timezone' => $this->timezone,
            'company' => $this->company,
            'avatar_url' => $this->avatarUri,
            'can_send_documents' => $this->canSendDocuments,
            'is_grace_period' => $this->isGracePeriod,
            'cancellation_date' => $this->cancellationDate,
        ];

        return array_merge($base, $user);
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
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * @param mixed $timezone
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @return mixed
     */
    public function getAvatarUri()
    {
        return $this->avatarUri;
    }

    /**
     * @param mixed $avatarUri
     */
    public function setAvatarUri($avatarUri)
    {
        $this->avatarUri = $avatarUri;
    }

    /**
     * @return bool
     */
    public function isCanSendDocuments()
    {
        return $this->canSendDocuments;
    }

    /**
     * @param bool $canSendDocuments
     */
    public function setCanSendDocuments($canSendDocuments)
    {
        $this->canSendDocuments = $canSendDocuments;
    }

    /**
     * @return bool
     */
    public function isGracePeriod()
    {
        return $this->isGracePeriod;
    }

    /**
     * @param bool $isGracePeriod
     */
    public function setIsGracePeriod($isGracePeriod)
    {
        $this->isGracePeriod = $isGracePeriod;
    }

    /**
     * @return mixed
     */
    public function getCancellationDate()
    {
        return $this->cancellationDate;
    }

    /**
     * @param mixed $cancellationDate
     */
    public function setCancellationDate($cancellationDate)
    {
        $this->cancellationDate = $cancellationDate;
    }
}