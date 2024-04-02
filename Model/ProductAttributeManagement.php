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

use Magecore\AttributeManagement\Api\ProductAttributeManagementInterface;
use Magecore\AttributeManagement\Api\AttributeManagementInterface;
use Magecore\AttributeManagement\Api\AttributeSetManagementInterface;
use Magento\Catalog\Model\Product;

class ProductAttributeManagement implements ProductAttributeManagementInterface
{
    /**
     * @param AttributeManagementInterface $attributeManagement
     * @param AttributeSetManagementInterface $attributeSetManagement
     */
    public function __construct(
        private readonly AttributeManagementInterface $attributeManagement,
        private readonly AttributeSetManagementInterface $attributeSetManagement
    ) {
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): void
    {
        $this->attributeManagement->create(Product::ENTITY, $data['code'], $data['config']);

        if (empty($data['attribute_sets'])) {
            $data['attribute_sets'] = [
                'Default'
            ];
        }
        if (empty($data['group_name'])) {
            $data['group_name'] = 'General';
        }
        foreach ($data['attribute_sets'] as $attributeSetName) {
            $this->attributeSetManagement->addToAttributeSetGroup(
                Product::ENTITY,
                $data['code'],
                $attributeSetName,
                $data['group_name'],
                $data['config']['sort_order']
            );
        }
    }

    /**
     * @inheritDoc
     */
    public function remove(string $code): void
    {
        $this->attributeManagement->remove(Product::ENTITY, $code);
    }

    /**
     * @inheritDoc
     */
    public function update(array $attributeData): void
    {
        $this->attributeManagement->update(
            Product::ENTITY,
            $attributeData['code'],
            $attributeData['field'],
            $attributeData['value']
        );

        foreach ($attributeData['attribute_sets'] as $attributeSetName) {
            $this->attributeSetManagement->addToAttributeSetGroup(
                Product::ENTITY,
                $attributeData['code'],
                $attributeSetName,
                $attributeData['group_name'],
                $attributeData['sort_order']
            );
        }
    }
}
