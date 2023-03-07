<?php
namespace Scandiweb\Assignment\Plugin\Block\Checkout;

class LayoutProcessor
{
    /**
     * Process js Layout of block
     *
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        array $jsLayout
    ) {
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']['children']['company']['visible'] = 0;
        return $jsLayout;
    }
}
