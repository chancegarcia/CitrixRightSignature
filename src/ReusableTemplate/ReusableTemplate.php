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

namespace Chance\CitrixRightSignature\ReusableTemplate;

use Chance\CitrixRightSignature\PersonInterface;

class ReusableTemplate implements ReusableTemplateInterface
{
    private $id;

    private $name;

    /**
     * @var PersonInterface
     */
    private $creator;

    private $expiresIn;

    private $signerSequencing = false;

    private $sharedWith = [];

    private $distributionMethod;

    private $identityMethod;

    private $kba;

    private $passcode;

    private $filename;

    /**
     * @var ReusabeTemplateTagInterface[]
     */
    private $tags;

    private $userId;

    /**
     * @var ReusableTemplateRoleInterface[]
     */
    private $roles = [];

    private $mergeFieldComponents = [];

    private $createdAt;

    private $updatedAt;

    private $thumbnailUri;

    private $pageImageUris = [];

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
            'name' => $this->name,
            'creator' => json_encode($this->creator),
            'expires_in' => $this->expiresIn,
            'signer_sequencing' => $this->signerSequencing,
            'shared_with' => $this->sharedWith,
            'distribution_method' => $this->distributionMethod,
            'identity_method' => $this->identityMethod,
            'kba' => $this->kba,
            'passcode' => $this->passcode,
            'filename' => $this->filename,
            'tags' => json_encode($this->tags),
            'user_id' => $this->userId,
            'roles' => json_encode($this->roles),
            'merge_field_components' => $this->mergeFieldComponents,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
            'thumbnail_url' => $this->thumbnailUri,
            'page_image_urls' => $this->pageImageUris,
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
     * @return PersonInterface
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @param PersonInterface $creator
     */
    public function setCreator(PersonInterface $creator)
    {
        $this->creator = $creator;
    }

    /**
     * @return mixed
     */
    public function getExpiresIn()
    {
        return $this->expiresIn;
    }

    /**
     * @param mixed $expiresIn
     */
    public function setExpiresIn($expiresIn)
    {
        $this->expiresIn = $expiresIn;
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
     * @return array
     */
    public function getSharedWith()
    {
        return $this->sharedWith;
    }

    /**
     * @param array $sharedWith
     */
    public function setSharedWith($sharedWith)
    {
        $this->sharedWith = $sharedWith;
    }

    /**
     * @return mixed
     */
    public function getDistributionMethod()
    {
        return $this->distributionMethod;
    }

    /**
     * @param mixed $distributionMethod
     */
    public function setDistributionMethod($distributionMethod)
    {
        $this->distributionMethod = $distributionMethod;
    }

    /**
     * @return mixed
     */
    public function getKba()
    {
        return $this->kba;
    }

    /**
     * @param mixed $kba
     */
    public function setKba($kba)
    {
        $this->kba = $kba;
    }

    /**
     * @return mixed
     */
    public function getPasscode()
    {
        return $this->passcode;
    }

    /**
     * @param mixed $passcode
     */
    public function setPasscode($passcode)
    {
        $this->passcode = $passcode;
    }

    /**
     * @return mixed
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param mixed $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @return ReusableTemplateRoleInterface[]
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param ReusableTemplateRoleInterface[] $roles
     */
    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }

    /**
     * @return array
     */
    public function getMergeFieldComponents()
    {
        return $this->mergeFieldComponents;
    }

    /**
     * @param array $mergeFieldComponents
     */
    public function setMergeFieldComponents(array $mergeFieldComponents)
    {
        $this->mergeFieldComponents = $mergeFieldComponents;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return mixed
     */
    public function getThumbnailUri()
    {
        return $this->thumbnailUri;
    }

    /**
     * @param mixed $thumbnailUri
     */
    public function setThumbnailUri($thumbnailUri)
    {
        $this->thumbnailUri = $thumbnailUri;
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
     * @return ReusabeTemplateTagInterface[]
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param ReusabeTemplateTagInterface[] $tags
     */
    public function setTags(array $tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
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
}