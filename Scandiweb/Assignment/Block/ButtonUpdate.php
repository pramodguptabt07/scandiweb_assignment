<?php
namespace Scandiweb\Assignment\Block;

use Scandiweb\Assignment\Model\ConfigInterface;

class ButtonUpdate extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Scandiweb\Assignment\Model\ConfigInterface $buttonConfig
     */
    protected $buttonConfig;
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public $scopeConfig;

    /**
     * Constructor function
     *
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Scandiweb\Assignment\Model\ConfigInterface $buttonConfig
     * @param array $data
     * @return void
     */

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        ConfigInterface $buttonConfig,
        array $data = []
    ) {
        $this->buttonConfig = $buttonConfig;
        $this->scopeConfig = $scopeConfig;
        
        parent::__construct($context, $data);
    }

    /**
     * Return the button color
     *
     * @return mixed
     */

    public function getButtonColor()
    {
        
        $valueFromConfig = $this->scopeConfig->getValue(
            'scandiweb/assignment/button_color',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
        );
        return $valueFromConfig;
    }
}
