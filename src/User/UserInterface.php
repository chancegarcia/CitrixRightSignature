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

use Chance\CitrixRightSignature\PersonInterface;

interface UserInterface extends PersonInterface
{
    const ME_ENDPOINT = '/public/v1/me';

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
    public function getTimezone();

    /**
     * @param mixed $timezone
     */
    public function setTimezone($timezone);

    /**
     * @return mixed
     */
    public function getCompany();

    /**
     * @param mixed $company
     */
    public function setCompany($company);

    /**
     * @return mixed
     */
    public function getAvatarUri();

    /**
     * @param mixed $avatarUri
     */
    public function setAvatarUri($avatarUri);

    /**
     * @return bool
     */
    public function isCanSendDocuments();

    /**
     * @param bool $canSendDocuments
     */
    public function setCanSendDocuments($canSendDocuments);

    /**
     * @return bool
     */
    public function isGracePeriod();

    /**
     * @param bool $isGracePeriod
     */
    public function setIsGracePeriod($isGracePeriod);

    /**
     * @return mixed
     */
    public function getCancellationDate();

    /**
     * @param mixed $cancellationDate
     */
    public function setCancellationDate($cancellationDate);
}