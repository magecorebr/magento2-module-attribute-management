<?php
/**
 * @copyright (c) 2024 Magecore
 * @url https://magecore.com.br
 * @author Marcio Maciel <os@magecore.com.br>
 * @license See LICENSE.md in the module root directory for license information.
 *
 */
declare(strict_types=1);

namespace Magecore\AttributeManagement\Api;

interface ProductAttributeManagementInterface
{
    /**
     * Create a product eav attribute
     *
     * @param array $data
     */
    public function create(array $data): void;

    /**
     * Remove a product eav attribute
     *
     * @param string $code
     */
    public function remove(string $code): void;

    /**
     * Update product eav attribute
     *
     * @param array $attributeData
     */
    public function update(array $attributeData): void;
}
