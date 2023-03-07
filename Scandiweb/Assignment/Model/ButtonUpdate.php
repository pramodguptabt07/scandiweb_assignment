<?php

namespace Scandiweb\Assignment\Model;

use Scandiweb\Assignment\Model\ConfigInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;
use \Magento\Store\Model\StoreRepository;

class ButtonUpdate
{
    /**
     * @var \Scandiweb\Assignment\Model\ConfigInterface $buttonConfig
     */
    protected $buttonConfig;
    /**
     * @var \Magento\Framework\App\Config\Storage\WriterInterface $configWriter
     */
    protected $configWriter;
    /**
     * @var \Magento\Store\Model\StoreRepository $_storeRepository
     */
    protected $_storeRepository;
    
    public const PATH = 'scandiweb/assignment/button_color';
        /**
         * Construct Function
         *
         * @param \Scandiweb\Assignment\Model\ConfigInterface $buttonConfig
         * @param \Magento\Framework\App\Config\Storage\WriterInterface $configWriter
         * @param \Magento\Store\Model\StoreRepository $storeRepository
         * @return void
         */
    public function __construct(
        ConfigInterface $buttonConfig,
        WriterInterface $configWriter,
        StoreRepository $storeRepository
    ) {
        $this->buttonConfig = $buttonConfig;
        $this->configWriter = $configWriter;
        $this->_storeRepository = $storeRepository;
    }

    /**
     * Return the button Color to the block
     *
     * @return string
     */
    public function getButtonColor()
    {
        return $this->buttonConfig->getStoreButtonColor();
    }

     /**
      * Verify the hex color code
      *
      * @param mixed $hexacode
      * @return bool
      */
       
    public function checkHexColor($hexacode)
    {
        if (preg_match('/^[a-f0-9]{6}$/i', $hexacode)) {
            return true;
        } else {
            return false;
        }
    }

     /**
      * Check the store provided is valid or not
      *
      * @param mixed $storeID
      * @return bool
      */
    public function _isCheckStore($storeID)
    {
        $stores = $this->_storeRepository->getList();
        $storeList = [];
        foreach ($stores as $store) {
            $storeList[] = $store["store_id"];
        }
        $allStoreList =  $storeList;
        if (in_array($storeID, $allStoreList)) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Save button color and return the msg
     *
     * @param mixed $hexCode
     * @param mixed $storeID
     * @return string
     */

    public function saveBtnColor($hexCode, $storeID)
    {
        $scope = \Magento\Store\Model\ScopeInterface::SCOPE_STORES;
        $path = self::PATH;
        $msg = '';
        if ($this->_isCheckStore($storeID) && $this->checkHexColor($hexCode)) {
            $this->configWriter->save($path, $hexCode, $scope, $storeID);
            $msg = "Button Color Updated. Please Refresh the cache";
        } else {
            $msg = "Problem in the value passed";
        }
        return $msg;
    }
}
