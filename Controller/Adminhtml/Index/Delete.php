<?php

namespace Eagle\Membership\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Ui\Component\MassAction\Filter;
use Eagle\Membership\Model\IndexFactory;
use Eagle\Membership\Model\ResourceModel\Index\CollectionFactory;

class Delete extends Action
{
    private $indexFactory;
    private $filter;
    private $collectionFactory;
    private $resultRedirect;

    public function __construct(
        Action\Context $context,
        IndexFactory $indexFactory,
        Filter $filter,
        CollectionFactory $collectionFactory,
        RedirectFactory $redirectFactory
    ) {
        parent::__construct($context);
        $this->indexFactory = $indexFactory;
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->resultRedirect = $redirectFactory;
    }

    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $total = 0;
        $err = 0;
        foreach ($collection->getItems() as $item) {
            $deletePost = $this->indexFactory->create()->load($item->getData('membership_id'));
            try {
                $deletePost->delete();
                $total++;
            } catch (LocalizedException $exception) {
                $err++;
            }
        }

        if ($total) {
            $this->messageManager->addSuccessMessage(
                __('A total of %1 record(s) have been deleted.', $total)
            );
        }

        if ($err) {
            $this->messageManager->addErrorMessage(
                __(
                    'A total of %1 record(s) haven\'t been deleted. Please see server logs for more details.',
                    $err
                )
            );
        }
        return $this->resultRedirect->create()->setPath('membership/index/index');
    }
}
