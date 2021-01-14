<?php

namespace Eagle\Membership\Ui\Component\Membership\Listing\Column;

use Magento\Cms\Block\Adminhtml\Page\Grid\Renderer\Action\UrlBuilder;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Escaper;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class Actions extends Column
{

    const CMS_URL_PATH_EDIT = 'membership/index/edit';
    const CMS_URL_PATH_DELETE = 'membership/index/delete';

    protected  $urlBuilder;

    protected $editUrl;


    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlBuilder $actionUrlBuilder,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = [],
        $editUrl = self::CMS_URL_PATH_EDIT,
        $deleteUrl = self::CMS_URL_PATH_DELETE,
        UrlBuilder $scopeUrlBuilder = null
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->actionUrlBuilder = $actionUrlBuilder;
        $this->editUrl = $editUrl;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
//
    public function prepareDataSource(array $dataSource)
    {
        $obj = \Magento\Framework\App\ObjectManager::getInstance();
        $store = $obj->create('\Magento\Store\Model\StoreManagerInterface');
        $url = $store->getStore()->getBaseUrl();
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $name = $this->getData('name');
                $item[$name]['edit'] = [
                    'href' => $this->urlBuilder->getUrl($this->editUrl, ['membership_id' => $item['membership_id']]),
                    'label' => __('Edit'),
                ];
//                $item[$name]['delete'] = [
//                    'href' => $this->urlBuilder->getUrl($this->deleteUrl, ['membership_id' => $item['membership_id']]),
//                    'label' => __('delete'),
//                ];
            }
//                $item[$this->getData('name')] = [
//                    'edit' => [
//                        'href' => $url . 'eagle/membership/index/add/' , $item["membership_id"],
//
//                        'label' => __('Edit')
//                    ]
//                ];
            }


        return $dataSource;
    }
}
