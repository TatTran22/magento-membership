<?php

namespace Eagle\Membership\Block;

use Eagle\Membership\Model\IndexFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class View extends Template
{
    protected $_indexFactory;

    public function __construct(
        Context $context,
        IndexFactory $indexFactory
    )
    {
        $this->_indexFactory = $indexFactory;
        parent::__construct($context);
    }

    public function getSingleData()
    {
        $id = $this->getRequest()->getParam('id');
        return $this->_indexFactory->create()->load($id);

    }
}
