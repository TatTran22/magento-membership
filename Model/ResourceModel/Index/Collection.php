<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eagle\Membership\Model\ResourceModel\Index;

use Eagle\Membership\Api\Data\MembershipInterface;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Eagle\Membership\Api\MembershipRepositoryInterface;
use Eagle\Membership\Api\Data;
use Eagle\Membership\Model\ResourceModel\Index as ResourceBlock;
use Eagle\Membership\Model\ResourceModel\Index\CollectionFactory as BlockCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;
/**
 * CMS Block Collection
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'membership_id';

//    /**
//     * Event prefix
//     *
//     * @var string
//     */
//    protected $_eventPrefix = 'cms_block_collection';

    /**
     * Event object
     *
     * @var string
     */
    protected $_eventObject = 'membership_collection';



    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Eagle\Membership\Model\Index', 'Eagle\Membership\Model\ResourceModel\Index');
        $this->_map['fields']['membership_id'] = 'main_table.membership_id';
    }

    /**
     * Returns pairs membership_id - name
     *
     * @return array
     */
    public function toOptionArray()
    {
        return $this->_toOptionArray('membership_id', 'name');
    }

    /**
     * Add filter by store
     *
     * @param int|array|\Magento\Store\Model\Store $store
     * @param bool $withAdmin
     * @return $this
     */
    public function addStoreFilter($store, $withAdmin = true)
    {
        $this->performAddStoreFilter($store, $withAdmin);

        return $this;
    }


}
