<?php
namespace Scandiweb\Assignment\Block;

use Scandiweb\Assignment\Model\ConfigInterface;


class ButtonUpdate extends \Magento\Framework\View\Element\Template {
    
    protected $buttonConfig;
    public $scopeConfig;


    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        ConfigInterface $buttonConfig,
       
        array $data = []
    )
    {        
        $this->buttonConfig = $buttonConfig;
        $this->scopeConfig = $scopeConfig;
        
        parent::__construct($context, $data);
    }

    public function getButtonColor()
    {
        
        $valueFromConfig = $this->scopeConfig->getValue(
            'scandiweb/assignment/button_color',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
        );
        return $valueFromConfig;
    //    return $this->buttonConfig->getStoreButtonColor();
    }

   

}