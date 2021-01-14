<?php

namespace Eagle\Membership\Model;

use Magento\Framework\Model\AbstractModel;

class Index extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Eagle\Membership\Model\ResourceModel\Index');
    }
}
