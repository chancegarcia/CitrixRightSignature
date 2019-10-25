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

// https://api.rightsignature.com/documentation/resources/v1/documents/show.en.html

class Document implements DocumentInterface
{
    private $id;

    private $currentSignerId;

    private $name;

    private $fileName;

    private $executedAt;

    private $expiredAt;

    private $sentAt;

    private $state;

    private $thumnailUri;

    /**
     * @var SenderInterface
     */
    private $sender;

    /**
     * @var RecipientInterface[]
     */
    private $recipients = [];

    private $audits = [];

    private $pageImageUris = [];

    private $signedPdfUri;

    private $tags = []; // {}

    private $mergeFieldValues = [];

    private $embedCodes;

    private $inPerson = false;

    private $sharedWith = [];

    private $identityMethod;

    private $passcodePinEnabled = false;

    private $originalFileUri;

    private $signatureCertificateUri;

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'current_signer_id' => $this->currentSignerId,
            'name' => $this->name,
            'filename' => $this->fileName,
            'executed_at' => $this->executedAt,
            'sent_at' => $this->sentAt,
            'state' => $this->state,
            'thumbnail_url' => $this->thumnailUri,
            'sender' => json_encode($this->sender),
            'recipients' => json_encode($this->recipients),
            'audits' => $this->audits,
            'page_image_urls' => $this->pageImageUris,
            'signed_pdf_url' => $this->signedPdfUri,
            'tags' => $this->tags,
            'merge_field_values' => $this->mergeFieldValues,
            'embed_codes' => $this->embedCodes,
            'in_person' => $this->inPerson,
            'shared_with' => $this->sharedWith,
            'identity_method' => $this->identityMethod,
            'passcode_pin_enabled' => $this->passcodePinEnabled,
            'original_file_url' => $this->originalFileUri,
            'signature_certificat_url' => $this->signatureCertificateUri,
        ];
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
    public function getCurrentSignerId()
    {
        return $this->currentSignerId;
    }

    /**
     * @param mixed $currentSignerId
     */
    public function setCurrentSignerId($currentSignerId)
    {
        $this->currentSignerId = $currentSignerId;
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
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param mixed $fileName
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @return mixed
     */
    public function getExecutedAt()
    {
        return $this->executedAt;
    }

    /**
     * @param mixed $executedAt
     */
    public function setExecutedAt($executedAt)
    {
        $this->executedAt = $executedAt;
    }

    /**
     * @return mixed
     */
    public function getExpiredAt()
    {
        return $this->expiredAt;
    }

    /**
     * @param mixed $expiredAt
     */
    public function setExpiredAt($expiredAt)
    {
        $this->expiredAt = $expiredAt;
    }

    /**
     * @return mixed
     */
    public function getSentAt()
    {
        return $this->sentAt;
    }

    /**
     * @param mixed $sentAt
     */
    public function setSentAt($sentAt)
    {
        $this->sentAt = $sentAt;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getThumnailUri()
    {
        return $this->thumnailUri;
    }

    /**
     * @param mixed $thumnailUri
     */
    public function setThumnailUri($thumnailUri)
    {
        $this->thumnailUri = $thumnailUri;
    }

    /**
     * @return SenderInterface
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param SenderInterface $sender
     */
    public function setSender(SenderInterface $sender)
    {
        $this->sender = $sender;
    }

    /**
     * @return array
     */
    public function getRecipients()
    {
        return $this->recipients;
    }

    /**
     * @param array $recipients
     */
    public function setRecipients(array $recipients)
    {
        $this->recipients = $recipients;
    }

    /**
     * @return array
     */
    public function getAudits()
    {
        return $this->audits;
    }

    /**
     * @param array $audits
     */
    public function setAudits(array $audits)
    {
        $this->audits = $audits;
    }

    /**
     * @return array
     */
    public function getPageImageUris()
    {
        return $this->pageImageUris;
    }

    /**
     * @param array $pageImageUris
     */
    public function setPageImageUris(array $pageImageUris)
    {
        $this->pageImageUris = $pageImageUris;
    }

    /**
     * @return mixed
     */
    public function getSignedPdfUri()
    {
        return $this->signedPdfUri;
    }

    /**
     * @param mixed $signedPdfUri
     */
    public function setSignedPdfUri($signedPdfUri)
    {
        $this->signedPdfUri = $signedPdfUri;
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     */
    public function setTags(array $tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return array
     */
    public function getMergeFieldValues()
    {
        return $this->mergeFieldValues;
    }

    /**
     * @param array $mergeFieldValues
     */
    public function setMergeFieldValues(array $mergeFieldValues)
    {
        $this->mergeFieldValues = $mergeFieldValues;
    }

    /**
     * @return mixed
     */
    public function getEmbedCodes()
    {
        return $this->embedCodes;
    }

    /**
     * @param mixed $embedCodes
     */
    public function setEmbedCodes($embedCodes)
    {
        $this->embedCodes = $embedCodes;
    }

    /**
     * @return bool
     */
    public function isInPerson()
    {
        return $this->inPerson;
    }

    /**
     * @param bool $inPerson
     */
    public function setInPerson($inPerson)
    {
        $this->inPerson = $inPerson;
    }

    /**
     * @return array
     */
    public function getSharedWith()
    {
        return $this->sharedWith;
    }

    /**
     * @param array $sharedWith
     */
    public function setSharedWith(array $sharedWith)
    {
        $this->sharedWith = $sharedWith;
    }

    /**
     * @return mixed
     */
    public function getIdentityMethod()
    {
        return $this->identityMethod;
    }

    /**
     * @param mixed $identityMethod
     */
    public function setIdentityMethod($identityMethod)
    {
        $this->identityMethod = $identityMethod;
    }

    /**
     * @return bool
     */
    public function isPasscodePinEnabled()
    {
        return $this->passcodePinEnabled;
    }

    /**
     * @param bool $passcodePinEnabled
     */
    public function setPasscodePinEnabled($passcodePinEnabled)
    {
        $this->passcodePinEnabled = $passcodePinEnabled;
    }

    /**
     * @return mixed
     */
    public function getOriginalFileUri()
    {
        return $this->originalFileUri;
    }

    /**
     * @param mixed $originalFileUri
     */
    public function setOriginalFileUri($originalFileUri)
    {
        $this->originalFileUri = $originalFileUri;
    }

    /**
     * @return mixed
     */
    public function getSignatureCertificateUri()
    {
        return $this->signatureCertificateUri;
    }

    /**
     * @param mixed $signatureCertificateUri
     */
    public function setSignatureCertificateUri($signatureCertificateUri)
    {
        $this->signatureCertificateUri = $signatureCertificateUri;
    }
}