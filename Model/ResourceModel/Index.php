<?php

namespace Eagle\Membership\Model\ResourceModel;

class Index extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('membership', "membership_id");
    }
}
