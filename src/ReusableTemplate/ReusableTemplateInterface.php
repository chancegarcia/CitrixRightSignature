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

interface ReusableTemplateInterface extends \JsonSerializable
{
    const BASE_ENDPOINT = '/public/v1/reusable_templates';
    const LIST_ENDPOINT = self::BASE_ENDPOINT;

    const SHOW_ENDPOINT = self::BASE_ENDPOINT . '/:id';
    const SEND_DOCUMENT_ENDPOINT = self::SHOW_ENDPOINT . '/send_document';
    const PREPARE_DOCUMENT_ENDPOINT = self::SHOW_ENDPOINT . '/prepare_document';
    const EMBED_DOCUMENT_ENDPOINT = self::SHOW_ENDPOINT . '/embed_document';

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
    public function getName();

    /**
     * @param mixed $name
     */
    public function setName($name);

    /**
     * @return PersonInterface
     */
    public function getCreator();

    /**
     * @param PersonInterface $creator
     */
    public function setCreator(PersonInterface $creator);

    /**
     * @return mixed
     */
    public function getExpiresIn();

    /**
     * @param mixed $expiresIn
     */
    public function setExpiresIn($expiresIn);

    /**
     * @return bool
     */
    public function isSignerSequencing();

    /**
     * @param bool $signerSequencing
     */
    public function setSignerSequencing($signerSequencing);

    /**
     * @return array
     */
    public function getSharedWith();

    /**
     * @param array $sharedWith
     */
    public function setSharedWith($sharedWith);

    /**
     * @return mixed
     */
    public function getDistributionMethod();

    /**
     * @param mixed $distributionMethod
     */
    public function setDistributionMethod($distributionMethod);

    /**
     * @return mixed
     */
    public function getKba();

    /**
     * @param mixed $kba
     */
    public function setKba($kba);

    /**
     * @return mixed
     */
    public function getPasscode();

    /**
     * @param mixed $passcode
     */
    public function setPasscode($passcode);

    /**
     * @return mixed
     */
    public function getFilename();

    /**
     * @param mixed $filename
     */
    public function setFilename($filename);

    /**
     * @return ReusableTemplateRoleInterface[]
     */
    public function getRoles();

    /**
     * @param ReusableTemplateRoleInterface[] $roles
     */
    public function setRoles(array $roles);

    /**
     * @return array
     */
    public function getMergeFieldComponents();

    /**
     * @param array $mergeFieldComponents
     */
    public function setMergeFieldComponents(array $mergeFieldComponents);

    /**
     * @return mixed
     */
    public function getCreatedAt();

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt);

    /**
     * @return mixed
     */
    public function getUpdatedAt();

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt);

    /**
     * @return mixed
     */
    public function getThumbnailUri();

    /**
     * @param mixed $thumbnailUri
     */
    public function setThumbnailUri($thumbnailUri);

    /**
     * @return array
     */
    public function getPageImageUris();

    /**
     * @param array $pageImageUris
     */
    public function setPageImageUris(array $pageImageUris);

    /**
     * @return ReusabeTemplateTagInterface[]
     */
    public function getTags();

    /**
     * @param ReusabeTemplateTagInterface[] $tags
     */
    public function setTags(array $tags);

    /**
     * @return mixed
     */
    public function getUserId();

    /**
     * @param mixed $userId
     */
    public function setUserId($userId);

    /**
     * @return mixed
     */
    public function getIdentityMethod();

    /**
     * @param mixed $identityMethod
     */
    public function setIdentityMethod($identityMethod);
}