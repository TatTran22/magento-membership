<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eagle\Membership\Model\ResourceModel\Index;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    protected $_idFieldName = 'membership_id';

    protected function _construct()
    {
        $this->_init('Eagle\Membership\Model\Index', 'Eagle\Membership\Model\ResourceModel\Index');
    }
}
