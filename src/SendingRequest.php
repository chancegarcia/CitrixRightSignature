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

// https://api.rightsignature.com/documentation/resources/v1/sending_requests/show.en.html

class SendingRequest implements SendingRequestInterface
{
    private $id;

    private $status;

    private $statusMessage;

    private $uploadUrl;

    private $documentTemplateId;

    /**
     * @todo change from string to \DateTime
     * @var string
     */
    private $createdAt;

    /**
     * @todo change from string to \DateTime
     * @var string
     */
    private $updatedAt;

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
        /*
         * {
  "sending_request": {
    "id": "bf98b25c-a16b-4709-82fc-54034e736077",
    "status": "waiting_for_file",
    "status_message": null,
    "upload_url": "https://rightsignature-sr-development.s3.amazonaws.com/public_api/sending_requests/bf98b25c-a16b-4709-82fc-54034e736077/my_upload.pdf?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAJSRMQNOZ6XOBJZ4A%2F20180507%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20180507T152332Z&X-Amz-Expires=3600&X-Amz-Signature=6ceecd6dfcf75b208b3cfd1386d9e6cd54c8df5ad9daa648fcc37fedef70f90f&X-Amz-SignedHeaders=Host&x-amz-acl=private",
    "document_template_id": null,
    "created_at": "2018-05-07T08:23:32.772-07:00",
    "updated_at": "2018-05-07T08:23:32.772-07:00"
  }
}
         */

        // maybe get fancy in the future and use inflector (https://github.com/doctrine/inflector) with reflection to create the array.

        return [
            'id' => $this->id,
            'status' => $this->status,
            'status_message' => $this->statusMessage,
            'upload_url' => $this->uploadUrl,
            'document_template_id' => $this->documentTemplateId,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
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
    public function getStatusMessage()
    {
        return $this->statusMessage;
    }

    /**
     * @param mixed $statusMessage
     */
    public function setStatusMessage($statusMessage)
    {
        $this->statusMessage = $statusMessage;
    }

    /**
     * @return mixed
     */
    public function getUploadUrl()
    {
        return $this->uploadUrl;
    }

    /**
     * @param mixed $uploadUrl
     */
    public function setUploadUrl($uploadUrl)
    {
        $this->uploadUrl = $uploadUrl;
    }

    /**
     * @return mixed
     */
    public function getDocumentTemplateId()
    {
        return $this->documentTemplateId;
    }

    /**
     * @param mixed $documentTemplateId
     */
    public function setDocumentTemplateId($documentTemplateId)
    {
        $this->documentTemplateId = $documentTemplateId;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param string $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return SendingRequestInterface
     */
    public static function generateNewInstance()
    {
        return new static();
    }

    /**
     * @param array $sendingRequestArray
     * @return SendingRequestInterface
     */
    public static function createFromApiResponse(array $sendingRequestArray)
    {
        $sendingRequest = static::generateNewInstance();
        $sendingRequest->setId($sendingRequestArray['id']);
        $sendingRequest->setStatus($sendingRequestArray['status']);
        $sendingRequest->setStatusMessage($sendingRequestArray['status_message']);
        $sendingRequest->setUploadUrl($sendingRequestArray['upload_url']);
        $sendingRequest->setDocumentTemplateId($sendingRequestArray['document_template_id']);
        $sendingRequest->setCreatedAt($sendingRequestArray['created_at']);
        $sendingRequest->setUpdatedAt($sendingRequestArray['updated_at']);

        return $sendingRequest;
    }
}