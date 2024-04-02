<?php
/**
 * @copyright (c) 2024 Magecore
 * @url https://magecore.com.br
 * @author Marcio Maciel <os@magecore.com.br>
 * @license See LICENSE.md in the module root directory for license information.
 *
 */
declare(strict_types=1);

namespace Magecore\AttributeManagement\Plugin;

use Magento\Catalog\Model\Attribute\Config;
use Magento\Catalog\Model\ResourceModel\Eav\Attribute;

class ManageSystemEavAttributeOptionLabel
{

    /**
     * @param Config $config
     */
    public function __construct(private readonly Config $config)
    {
    }

    /**
     * Enforce attribute option management through the admin UI for non user_defined attributes
     *
     * @param Attribute $subject
     * @return void
     */
    public function afterAfterLoad(Attribute $subject): void
    {
        $attributeName = 'can_manage_option_labels';
        $allowedAttributes = $this->config->getAttributeNames($attributeName);

        if (in_array($subject->getAttributeCode(), $allowedAttributes)) {
            $subject->setData($attributeName, true);
        }
    }
}
