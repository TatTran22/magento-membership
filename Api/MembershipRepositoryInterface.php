<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eagle\Membership\Api;

/**
 * CMS block CRUD interface.
 * @api
 * @since 100.0.2
 */
interface MembershipRepositoryInterface
{
    /**
     * Save block.
     *
     * @param \Eagle\Membership\Api\Data\MembershipInterface $membership
     * @return \Eagle\Membership\Api\Data\MembershipInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(Data\MembershipInterface $membership);

    /**
     * Retrieve block.
     *
     * @param string $membershipId
     * @return \Eagle\Membership\Api\Data\MembershipInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($membershipId);

    /**
     * Retrieve blocks matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Eagle\Membership\Api\Data\MembershipSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList();

    /**
     * Delete block.
     *
     * @param \Eagle\Membership\Api\Data\MembershipInterface $membership
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(Data\MembershipInterface $membership);

    /**
     * Delete block by ID.
     *
     * @param string $membershipId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($membershipId);
}
