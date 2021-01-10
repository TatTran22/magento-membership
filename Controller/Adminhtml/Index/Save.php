<?php

namespace Eagle\Membership\Controller\Adminhtml\Index;

use Eagle\Membership\Model\IndexFactory;
use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\RedirectFactory;

class Save extends Action
{
    private $resultRedirect;
    private $indexFactory;

    public function __construct(
        Action\Context $context,
        IndexFactory $indexFactory,
        RedirectFactory $redirectFactory
    ) {
        parent::__construct($context);
        $this->indexFactory = $indexFactory;
        $this->resultRedirect = $redirectFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $id = !empty($data['membership_id']) ? $data['membership_id'] : null;

        $newData = [
            'name' => $data['name'],
            'description' => $data['description'],
            'discount' => $data['discount'],
            'discount_type' => $data['discount_type'],
            'status' => $data['status'],
        ];

        $index = $this->indexFactory->create();
        if ($id) {
            $index->load($id);
            $this->getMessageManager()->addSuccessMessage(__('Data Edited Successfully.'));
        } else {
            $this->getMessageManager()->addSuccessMessage(__('Data Saved Successfully.'));
        }
        try {
            $index->addData($newData);
            $index->save();
            return $this->resultRedirect->create()->setPath('membership/index/index');
        } catch (\Exception $e) {
            $this->getMessageManager()->addErrorMessage(__('Data Saved Fail.'));
        }
    }
}
