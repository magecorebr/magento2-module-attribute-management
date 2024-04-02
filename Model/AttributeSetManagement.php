<?php
/**
 * @copyright (c) 2024 Magecore
 * @url https://magecore.com.br
 * @author Marcio Maciel <os@magecore.com.br>
 * @license See LICENSE.md in the module root directory for license information.
 *
 */
declare(strict_types=1);

namespace Magecore\AttributeManagement\Model;

use Magecore\AttributeManagement\Api\AttributeSetManagementInterface;
use Magento\Eav\Api\AttributeSetManagementInterface as FrameworkAttributeSetManagementInterface;
use Magento\Eav\Api\Data\AttributeSetInterfaceFactory;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\NoSuchEntityException;

class AttributeSetManagement implements AttributeSetManagementInterface
{
    /**
     * @param EavSetupFactory $eavSetupFactory
     * @param FrameworkAttributeSetManagementInterface $attributeSetManagement
     * @param AttributeSetInterfaceFactory $attributeSetFactory
     */
    public function __construct(
        private readonly EavSetupFactory $eavSetupFactory,
        private readonly FrameworkAttributeSetManagementInterface $attributeSetManagement,
        private readonly AttributeSetInterfaceFactory $attributeSetFactory
    ) {
    }

    /**
     * @inheritDoc
     *
     * @throws InputException|NoSuchEntityException
     */
    public function create(string $entityType, string $name, int $sortOrder = 0): void
    {
        $eavSetup = $this->eavSetupFactory->create();
        $defaultAttributeSetId = $eavSetup->getDefaultAttributeSetId($entityType);
        $attributeSet = $this->attributeSetFactory->create();
        $attributeSet->setEntityTypeId($entityType)
            ->setAttributeSetName($name)
            ->setSortOrder($sortOrder);

        $this->attributeSetManagement->create(
            $entityType,
            $attributeSet,
            $eavSetup->getDefaultAttributeSetId($defaultAttributeSetId)
        );
    }

    /**
     * @inheritDoc
     */
    public function remove(string $entityType, string $attributeSetName): void
    {
        $eavSetup = $this->eavSetupFactory->create();
        $attributeSetId = $eavSetup->getAttributeSet($entityType, $attributeSetName);
        if (!empty($attributeSetId)) {
            $eavSetup->removeAttributeSet($entityType, $attributeSetId);
        }
    }

    /**
     * @inheritDoc
     */
    public function addToAttributeSetGroup(
        string $entityType,
        string $attributeCode,
        string $attributeSet,
        string $groupName,
        int $sortOrder = null
    ): void {
        $eavSetup = $this->eavSetupFactory->create();
        $groupId = $eavSetup->getAttributeGroup($entityType, $attributeSet, $groupName, 'attribute_group_name');
        if (empty($groupId)) {
            $eavSetup->addAttributeGroup($entityType, $attributeSet, $groupName);
        }
        $eavSetup->addAttributeToGroup($entityType, $attributeSet, $groupName, $attributeCode, $sortOrder);
    }

    /**
     * @inheritDoc
     */
    public function removeFromAttributeSetGroup(string $entityType, string $groupName, string $attributeSet): void
    {
        $eavSetup = $this->eavSetupFactory->create();
        $eavSetup->removeAttributeGroup($entityType, $attributeSet, $groupName);
    }
}
