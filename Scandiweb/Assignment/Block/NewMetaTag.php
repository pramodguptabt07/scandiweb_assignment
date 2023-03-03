<?php
namespace Scandiweb\Assignment\Block;

class NewMetaTag extends \Magento\Framework\View\Element\Template
{
        protected $_store;
        protected $_storeManager;
        protected $_urlInterface;
        protected $_page;
 
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Locale\Resolver $store,        
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\UrlInterface $urlInterface,  
        \Magento\Cms\Model\Page $page,  
        array $data = []
    )
    {        
        $this->_storeManager = $storeManager;
        $this->_store = $store;
        $this->_urlInterface = $urlInterface;
        $this->_page = $page;
        parent::__construct($context, $data);
    }
    
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
    
    /**
     * Prining URLs using StoreManagerInterface
     */
    public function getStoreManagerData()
    {    
        // by default: URL_TYPE_LINK is returned
        echo $this->_storeManager->getStore()->getBaseUrl() . '<br />';        
        
    }

    public function getCmsIdentifier(){
       return $this->_page->getIdentifier();
    }
    public function currentStore(){
       return $this->_store->getLocale();
    }
    public function getStoreId()
    {
        return $this->_storeManager->getStore()->getId();
    }

    public function checkIsAvailable(){
        $identifier=$this->_page->getIdentifier();
        $storeId = $this->_storeManager->getStore()->getId();
        $pageId = $this->_page->checkIdentifier($identifier, $storeId);
        if ($pageId && $identifier!='no-route') {
            return true;
        } else {
            return false;
        }
    }
    
}
?>