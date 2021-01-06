<?php

namespace Eagle\Membership\Model;

class Index extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('Eagle\Membership\Model\ResourceModel\Index');
    }
}
