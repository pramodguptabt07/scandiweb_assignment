<?php
declare (strict_types = 1);

namespace Scandiweb\Assignment\Setup\Patch\Data;

use Magento\Catalog\Ui\DataProvider\Product\ProductCollectionFactory;
use Magento\Customer\Model\Customer;
use Magento\Eav\Model\Config;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Magento\Eav\Api\AttributeRepositoryInterface;
use Psr\Log\LoggerInterface;

/**
 * Class CustomerAttribute for Create Customer Attribute using Data Patch.
 *
 */
class CustomerAttribute implements DataPatchInterface, PatchRevertableInterface
{
   /**
    * @var ModuleDataSetupInterface
    */
    private $moduleDataSetup;

   /**
    * @var EavSetupFactory
    */
    private $eavSetupFactory;
   
   /**
    * @var ProductCollectionFactory
    */
    private $productCollectionFactory;
   
   /**
    * @var LoggerInterface
    */
    private $logger;
   
   /**
    * @var Config
    */
    private $eavConfig;
   
   /**
    * @var \Magento\Customer\Model\ResourceModel\Attribute
    */
    private $attributeResource;

    /**
     * @var AttributeRepositoryInterface
     */
    private $attributeRepository;

    /**
     * @var \Magento\Eav\Model\ResourceModel\Entity\Attribute
     */
    protected $_eavAttribute;

   /**
    * CustomerAttribute Constructor
    * @param EavSetupFactory $eavSetupFactory
    * @param Config $eavConfig
    * @param LoggerInterface $logger
    * @param \Magento\Eav\Api\AttributeRepositoryInterface $attributeRepository
    * @param \Magento\Customer\Model\ResourceModel\Attribute $attributeResource
    * @param   \Magento\Eav\Model\ResourceModel\Entity\Attribute $eavAttribute
    * @param \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup
    * @return void
    */
    public function __construct(
        EavSetupFactory $eavSetupFactory,
        Config $eavConfig,
        LoggerInterface $logger,
        AttributeRepositoryInterface $attributeRepository,
        \Magento\Customer\Model\ResourceModel\Attribute $attributeResource,
        \Magento\Eav\Model\ResourceModel\Entity\Attribute $eavAttribute,
        \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig = $eavConfig;
        $this->logger = $logger;
        $this->attributeResource = $attributeResource;
        $this->moduleDataSetup = $moduleDataSetup;
        $this->attributeRepository = $attributeRepository;
        $this->_eavAttribute = $eavAttribute;
    }

   /**
    * @inheritdoc
    */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $this->addPhoneAttribute();
        $this->moduleDataSetup->getConnection()->endSetup();
    }

   /**
    * Update the Phone attribute value
    *
    * @throws \Magento\Framework\Exception\AlreadyExistsException
    * @throws \Magento\Framework\Exception\LocalizedException
    * @throws \Zend_Validate_Exception
    */
    public function addPhoneAttribute()
    {
        $eavSetup = $this->eavSetupFactory->create();
        $attributeId = $this->_eavAttribute
        ->getIdByCode(\Magento\Customer\Model\Customer::ENTITY, 'telephone');
        $eavSetup->updateAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            $attributeId,
            [
                'is_required' => false
            ]
        );

        $attribute = $this->eavConfig->getAttribute(Customer::ENTITY, 'telephone');
  
        $this->attributeResource->save($attribute);
    }

    /**
     * Get Attribute Id
     *
     * @return int|null
     */

    public function getAttributeId()
    {
        $attribute = $this->attributeRepository->get(Customer::ENTITY, 'telephone');
        return $attribute->getAttributeId();
    }

   /**
    * @inheritdoc
    */
    public static function getDependencies()
    {
        return [];
    }

   /**
    * Rollback all changes, done by this patch
    *
    * @return void
    */
    public function revert()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $this->moduleDataSetup->getConnection()->endSetup();
    }

   /**
    * @inheritdoc
    */
    public function getAliases()
    {
        return [];
    }
}
