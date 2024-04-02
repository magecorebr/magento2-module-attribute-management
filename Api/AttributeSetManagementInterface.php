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

interface AttributeSetManagementInterface
{
    /**
     * Create an eav attribute set
     *
     * @param string $entityType
     * @param string $name
     * @param int $sortOrder
     */
    public function create(string $entityType, string $name, int $sortOrder = 0): void;

    /**
     * Remove attribute set by name and entity type id
     *
     * @param string $entityType
     * @param string $attributeSetName
     */
    public function remove(string $entityType, string $attributeSetName): void;

    /**
     * Add an attribute to attribute set group. Create new group if not exists
     *
     * @param string $entityType
     * @param string $attributeCode
     * @param string $attributeSet
     * @param string $groupName
     * @param int|null $sortOrder
     */
    public function addToAttributeSetGroup(
        string $entityType,
        string $attributeCode,
        string $attributeSet,
        string $groupName,
        int $sortOrder = null
    ): void;

    /**
     * Remove an attribute set from group
     *
     * @param string $entityType
     * @param string $groupName
     * @param string $attributeSet
     */
    public function removeFromAttributeSetGroup(string $entityType, string $groupName, string $attributeSet): void;
}
