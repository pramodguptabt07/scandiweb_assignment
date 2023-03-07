<?php
namespace Scandiweb\Assignment\Block;

class NewMetaTag extends \Magento\Framework\View\Element\Template
{

    /**
     * @var \Magento\Framework\Locale\Resolver $_store
     */
    protected $_store;
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;
    /**
     * @var \Magento\Framework\UrlInterface $_urlInterface
     */
    protected $_urlInterface;
    /**
     * @var \Magento\Cms\Model\Page $_page
     */
    protected $_page;
    
    /**
     * Constructor Function
     *

     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Locale\Resolver $store
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\UrlInterface $urlInterface
     * @param \Magento\Cms\Model\Page $page
     * @param array $data
     * @return void
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Locale\Resolver $store,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\UrlInterface $urlInterface,
        \Magento\Cms\Model\Page $page,
        array $data = []
    ) {
        $this->_storeManager = $storeManager;
        $this->_store = $store;
        $this->_urlInterface = $urlInterface;
        $this->_page = $page;
        parent::__construct($context, $data);
    }
    /**
     * Returns Cms Page Identifier
     *
     * @return string
     */
    public function getCmsIdentifier()
    {
        return $this->_page->getIdentifier();
    }
    /**
     * Returns Current Store Language
     *
     * @return string
     */
    public function currentStore()
    {
        return $this->_store->getLocale();
    }
    /**
     * Returns Current Store Id
     *
     * @return int
     */
    public function getStoreId()
    {
        return $this->_storeManager->getStore()->getId();
    }
    /**
     * Returns Check the page is available
     *
     * @return bool
     */
    public function checkIsAvailable()
    {
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
