<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Eagle\Membership\Model;

use Eagle\Membership\Api\Data\MembershipInterface;
use Eagle\Membership\Api\MembershipRepositoryInterface;
use Eagle\Membership\Model\ResourceModel\Index as ResourceBlock;
use Eagle\Membership\Model\ResourceModel\Index\CollectionFactory as MembershipCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class MembershipRepository
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class MembershipRepository implements MembershipRepositoryInterface
{
    protected $resource;

    protected $indexFactory;

    protected $membershipCollectionFactory;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $dataBlockFactory;

    private $storeManager;

    /**
     * @param ResourceBlock $resource
     * @param IndexFactory $indexFactory
     * @param MembershipCollectionFactory $membershipCollectionFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceBlock $resource,
        IndexFactory $indexFactory,
        MembershipCollectionFactory $membershipCollectionFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->indexFactory = $indexFactory;
        $this->membershipCollectionFactory = $membershipCollectionFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * Save Membership data
     *
     * @param MembershipInterface $membership
     * @return Membership
     * @throws CouldNotSaveException
     * @throws NoSuchEntityException
     */
    public function save(MembershipInterface $membership)
    {
        if (empty($membership->getMembershipId())) {
            $membership->setMembershipId($this->storeManager->getStore()->getId());
        }

        try {
            $this->resource->save($membership);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $membership;
    }

    /**
     * Load Membership data by given Membership Identity
     *
     * @param string $membershipId
     * @return Index
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($membershipId)
    {
        $membership = $this->indexFactory->create();
        $this->resource->load($membership, $membershipId);
        if (!$membership->getId()) {
            throw new NoSuchEntityException(__('The Membership with the "%1" ID doesn\'t exist.', $membershipId));
        }
        return $membership;
    }


    public function getList()
    {
        $collection = $this->indexFactory->create();


        return $collection;
    }

    /**
     * Delete Membership
     *
     * @param MembershipInterface $membership
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(MembershipInterface $membership)
    {
        try {
            $this->resource->delete($membership);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * Delete Membership by given Membership Identity
     *
     * @param string $membershipId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($membershipId): bool
    {
        return $this->delete($this->getById($membershipId));
    }


}
