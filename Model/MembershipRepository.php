<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Eagle\Membership\Model;

use Eagle\Membership\Api\Data\MembershipInterface;
use Eagle\Membership\Api\Data\MembershipInterfaceFactory;
use Eagle\Membership\Api\Data\MembershipSearchResultsInterface;
use Eagle\Membership\Api\MembershipRepositoryInterface;
use Eagle\Membership\Api\Data;
use Eagle\Membership\Model\ResourceModel\Index as ResourceBlock;
use Eagle\Membership\Model\ResourceModel\Index\CollectionFactory as MembershipCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
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
    /**
     * @var ResourceBlock
     */
    protected $resource;

    /**
     * @var IndexFactory
     */
    protected $indexFactory;

    /**
     * @var MembershipCollectionFactory
     */
    protected $membershipCollectionFactory;

    /**
     * @var Data\BlockSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var DataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * @var \Eagle\Membership\Api\Data\BlockInterfaceFactory
     */
    protected $dataBlockFactory;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @param ResourceBlock $resource
     * @param IndexFactory $indexFactory
     * @param MembershipInterfaceFactory $dataBlockFactory
     * @param MembershipCollectionFactory $membershipCollectionFactory
     * @param Data\MembershipSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface|null $collectionProcessor
     */
    public function __construct(
        ResourceBlock $resource,
        IndexFactory $indexFactory,
        MembershipInterfaceFactory $dataBlockFactory,
        MembershipCollectionFactory $membershipCollectionFactory,
        Data\MembershipSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor = null
    ) {
        $this->resource = $resource;
        $this->indexFactory = $indexFactory;
        $this->membershipCollectionFactory = $membershipCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataBlockFactory = $dataBlockFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor ?: $this->getCollectionProcessor();
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

    /**
     * Load Membership data collection by given search criteria
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @param SearchCriteriaInterface $criteria
     * @return MembershipSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $criteria)
    {
        /** @var \Eagle\Membership\Model\ResourceModel\Index\Collection $collection */
        $collection = $this->membershipCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        /** @var MembershipSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
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
    public function deleteById($membershipId)
    {
        return $this->delete($this->getById($membershipId));
    }

    /**
     * Retrieve collection processor
     *
     * @deprecated 102.0.0
     * @return CollectionProcessorInterface
     */
    private function getCollectionProcessor()
    {
        if (!$this->collectionProcessor) {
            $this->collectionProcessor = \Magento\Framework\App\ObjectManager::getInstance()->get(
                'Eagle\Membership\Model\Api\SearchCriteria\BlockCollectionProcessor'
            );
        }
        return $this->collectionProcessor;
    }
}
