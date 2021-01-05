<?php
namespace Eagle\Membership\Block\Adminhtml\Form\Field;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;
use Eagle\Membership\Block\Adminhtml\Form\Field\EnableColumn;

/**
 * Class Ranges
 */
class Enable extends AbstractFieldArray
{
    /**
     * @var EnableColumn
     */
    private \Eagle\Membership\Block\Adminhtml\Form\Field\EnableColumn $enableRenderer;

    /**
     * Prepare rendering the new field by adding all the needed columns
     */
    protected function _prepareToRender()
    {
//        $this->addColumn('from_qty', ['label' => __('From'), 'class' => 'required-entry']);
//        $this->addColumn('to_qty', ['label' => __('To'), 'class' => 'required-entry']);
//        $this->addColumn('price', ['label' => __('Price'), 'class' => 'required-entry']);
        $this->addColumn('tax', [
            'label' => __('Tax'),
            'renderer' => $this->getEnableRenderer()
        ]);
        $this->_addAfter = false;
//        $this->_addButtonLabel = __('Add');
    }

    /**
     * Prepare existing row data object
     *
     * @param DataObject $row
     * @throws LocalizedException
     */
    protected function _prepareArrayRow(DataObject $row): void
    {
        $options = [];

        $enable = $row->getEnable();
        if ($enable !== null) {
            $options['option_' . $this->getEnableRenderer()->calcOptionHash($enable)] = 'selected="selected"';
        }

        $row->setData('option_extra_attrs', $options);
    }

    /**
     * @return EnableColumn
     * @throws LocalizedException
     */
    private function getEnableRenderer(): \Eagle\Membership\Block\Adminhtml\Form\Field\EnableColumn
    {
        if (!$this->enableRenderer) {
            $this->enableRenderer = $this->getLayout()->createBlock(
                EnableColumn::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
        }
        return $this->enableRenderer;
    }
}
