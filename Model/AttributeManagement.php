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

use Magecore\AttributeManagement\Api\AttributeManagementInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Validator\ValidateException;

class AttributeManagement implements AttributeManagementInterface
{
    /**
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(private readonly EavSetupFactory $eavSetupFactory)
    {
    }

    /**
     * @inheritDoc
     *
     * @throws LocalizedException|ValidateException
     */
    public function create(string $entityType, string $code, array $config): void
    {
        $eavSetup = $this->eavSetupFactory->create();
        $eavSetup->addAttribute($entityType, $code, $config);
    }

    /**
     * @inheritDoc
     */
    public function remove(string $entityType, string $code): void
    {
        $eavSetup = $this->eavSetupFactory->create();
        $eavSetup->removeAttribute($entityType, $code);
    }

    /**
     * @inheritDoc
     */
    public function update(string $entityType, string $code, string $field, string $value): void
    {
        $eavSetup = $this->eavSetupFactory->create();
        $eavSetup->updateAttribute($entityType, $code, $field, $value);
    }
}
