<?php

namespace Eagle\Membership\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\Context;

class Index extends AbstractModel implements \Eagle\Membership\Api\Data\MembershipInterface
{
    public function getMembershipId()
    {
    }

    protected function _construct()
    {
        $this->_init('Eagle\Membership\Model\ResourceModel\Index');
    }
}
