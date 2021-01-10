<?php


namespace Eagle\Membership\Ui\Component\Membership\Listing\Column;


class DiscountType implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Value which equal Enable for Enabledisable dropdown.
     */
    const FIXED_VALUE = 1;

    /**
     * Value which equal Disable for Enabledisable dropdown.
     */
    const PERCENT_VALUE = 2;

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => self::FIXED_VALUE, 'label' => __('Fixed')],
            ['value' => self::PERCENT_VALUE, 'label' => __('Percent')],
        ];
    }
}
