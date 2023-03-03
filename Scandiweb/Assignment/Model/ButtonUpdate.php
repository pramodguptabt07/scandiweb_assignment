<?php

namespace Scandiweb\Assignment\Model;


use Scandiweb\Assignment\Model\ConfigInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;
use \Magento\Store\Model\StoreRepository;

    class ButtonUpdate  {
    
        protected $buttonConfig;
        protected $configWriter;
        protected $_storeRepository;
    
        public const Path = 'scandiweb/assignment/button_color';
        
        public function __construct(
          
            ConfigInterface $buttonConfig,
            WriterInterface $configWriter,
            StoreRepository $storeRepository
            
        )
        {        
            $this->buttonConfig = $buttonConfig;
            $this->configWriter = $configWriter;
            $this->_storeRepository = $storeRepository;
           
        }

        public function getButtonColor()
        {
           return $this->buttonConfig->getStoreButtonColor();
        }
       
        public function checkHexColor($hexacode)
        {
            if( preg_match('/^[a-f0-9]{6}$/i', $hexacode) ){return true; }
            else { return false; }
        }
    
        public function _isCheckStore($storeID){
            $stores = $this->_storeRepository->getList();
            $storeList = array();
            foreach ($stores as $store) {            
                $storeList[] = $store["store_id"];
            }
            $allStoreList =  $storeList;
            if (in_array($storeID, $allStoreList)) { return true;}
            else { return false; }
        }
    
        public function saveBtnColor($hexCode,$storeID){
            $scope = \Magento\Store\Model\ScopeInterface::SCOPE_STORES;
            $path = self::Path;
            $msg = '';
            if($this->_isCheckStore($storeID) && $this->checkHexColor($hexCode)){
                $this->configWriter->save($path, $hexCode, $scope , $storeID);
                $msg = "Button Color Updated. Please Refresh the cache";
            } else {
                $msg = "Problem in the value passed";
            }
            return $msg;
             
        }

}