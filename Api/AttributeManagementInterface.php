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

interface AttributeManagementInterface
{
    /**
     * Create an eav attribute
     *
     * @param string $entityType
     * @param string $code
     * @param array $config
     */
    public function create(string $entityType, string $code, array $config): void;

    /**
     * Remove an eav attribute
     *
     * @param string $entityType
     * @param string $code
     */
    public function remove(string $entityType, string $code): void;

    /**
     * Update an eav attribute
     *
     * @param string $entityType
     * @param string $code
     * @param string $field
     * @param string $value
     */
    public function update(string $entityType, string $code, string $field, string $value): void;
}
