<?php


namespace Eagle\Membership\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Eagle\Membership\Model\Index\IndexFactory;
use Magento\Backend\Model\View\Result\RedirectFactory;

class Save extends \Magento\Backend\App\Action
{
    protected $indexFactory;

    public function __construct(Action\Context $context, IndexFactory $indexFactory)
    {
        $this->indexFactory = $indexFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        $data = $this->getRequest()->getParams();
        $model = $this->indexFactory->create();
        $model->setData('name', $data['name']);
        $model->setData('description', $data['description']);
        $model->setData('discount', $data['discount']);
        $model->setData('discount_type', $data['discount_type']);
        $model->setData('status', $data['status']);
        $model->save();
    }
}
