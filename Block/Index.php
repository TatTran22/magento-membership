<?php


namespace Eagle\Membership\Block;


use Eagle\Membership\Model\IndexFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Index extends Template
{
    protected $_postFactory;
    public function __construct(
        Context $context,
        IndexFactory $indexFactory
    )
    {
        $this->_indexFactory = $indexFactory;
        parent::__construct($context);
    }

    public function getPostCollection(){
        $index = $this->_indexFactory->create();
        return $index->getCollection();
    }
}
