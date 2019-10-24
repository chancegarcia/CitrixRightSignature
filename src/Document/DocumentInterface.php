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

interface DocumentInterface extends \JsonSerializable
{
    const BASE_ENDPOINT = '/public/v1/documents';
    const LIST_ENDPOINT = self::BASE_ENDPOINT;

    const SHOW_ENDPOINT = self::BASE_ENDPOINT . '/:id';

    const SHARE_ENDPOINT = self::SHARE_ENDPOINT . '/share';

    const UPDATE_TAGS_ENDPOINT = self::BASE_ENDPOINT . '/update_tags';
    const VOID_ENDPOINT = self::BASE_ENDPOINT . '/void';
    const UPDATE_PIN_ENDPOINT = self::BASE_ENDPOINT . '/update_pin';

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
    public function getCurrentSignerId();

    /**
     * @param mixed $currentSignerId
     */
    public function setCurrentSignerId($currentSignerId);

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
    public function getFileName();

    /**
     * @param mixed $fileName
     */
    public function setFileName($fileName);

    /**
     * @return mixed
     */
    public function getExecutedAt();

    /**
     * @param mixed $executedAt
     */
    public function setExecutedAt($executedAt);

    /**
     * @return mixed
     */
    public function getExpiredAt();

    /**
     * @param mixed $expiredAt
     */
    public function setExpiredAt($expiredAt);

    /**
     * @return mixed
     */
    public function getSentAt();

    /**
     * @param mixed $sentAt
     */
    public function setSentAt($sentAt);

    /**
     * @return mixed
     */
    public function getState();

    /**
     * @param mixed $state
     */
    public function setState($state);

    /**
     * @return mixed
     */
    public function getThumnailUri();

    /**
     * @param mixed $thumnailUri
     */
    public function setThumnailUri($thumnailUri);

    /**
     * @return SenderInterface
     */
    public function getSender();

    /**
     * @param SenderInterface $sender
     */
    public function setSender(SenderInterface $sender);

    /**
     * @return RecipientInterface[]
     */
    public function getRecipients();

    /**
     * @param RecipientInterface[] $recipients
     */
    public function setRecipients(array $recipients);

    /**
     * @return array
     */
    public function getAudits();

    /**
     * @param array $audits
     */
    public function setAudits(array $audits);

    /**
     * @return array
     */
    public function getPageImageUris();

    /**
     * @param array $pageImageUris
     */
    public function setPageImageUris(array $pageImageUris);

    /**
     * @return mixed
     */
    public function getSignedPdfUri();

    /**
     * @param mixed $signedPdfUri
     */
    public function setSignedPdfUri($signedPdfUri);

    /**
     * @return array
     */
    public function getTags();

    /**
     * @param array $tags
     */
    public function setTags(array $tags);

    /**
     * @return array
     */
    public function getMergeFieldValues();

    /**
     * @param array $mergeFieldValues
     */
    public function setMergeFieldValues(array $mergeFieldValues);

    /**
     * @return mixed
     */
    public function getEmbedCodes();

    /**
     * @param mixed $embedCodes
     */
    public function setEmbedCodes($embedCodes);

    /**
     * @return bool
     */
    public function isInPerson();

    /**
     * @param bool $inPerson
     */
    public function setInPerson($inPerson);

    /**
     * @return array
     */
    public function getSharedWith();

    /**
     * @param array $sharedWith
     */
    public function setSharedWith(array $sharedWith);

    /**
     * @return mixed
     */
    public function getIdentityMethod();

    /**
     * @param mixed $identityMethod
     */
    public function setIdentityMethod($identityMethod);

    /**
     * @return bool
     */
    public function isPasscodePinEnabled();

    /**
     * @param bool $passcodePinEnabled
     */
    public function setPasscodePinEnabled($passcodePinEnabled);

    /**
     * @return mixed
     */
    public function getOriginalFileUri();

    /**
     * @param mixed $originalFileUri
     */
    public function setOriginalFileUri($originalFileUri);

    /**
     * @return mixed
     */
    public function getSignatureCertificateUri();

    /**
     * @param mixed $signatureCertificateUri
     */
    public function setSignatureCertificateUri($signatureCertificateUri);
}