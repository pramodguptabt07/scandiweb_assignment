<?php

namespace Scandiweb\Assignment\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Survey module configuration
 */
class Config implements ConfigInterface
{
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }
    
    /**
     * @inheritdoc
     */
    public function getStoreButtonColor()
    {
        return $this->scopeConfig->getValue(
            ConfigInterface::BUTTONCOLOR,
            ScopeInterface::SCOPE_STORE
        );
    }
}
