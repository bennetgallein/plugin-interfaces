<?php

namespace LibreNMS\Interfaces\Plugins;

use App\Models\Device;

/**
 * Contract for a device configuration backup source shown on the device Config tab.
 *
 * A plugin package implements this to add a backend and registers the class
 * with the LibreNMS config backup manager from its service provider.
 *
 */
interface ConfigBackupProvider
{
    public const ERROR_UNREACHABLE = 'unreachable';
    public const ERROR_API = 'error';
    public const ERROR_DEVICE_NOT_FOUND = 'device_not_found';
    public const ERROR_NO_BACKUPS = 'no_backups';
    public const ERROR_BACKUP_NOT_FOUND = 'backup_not_found';

    public static function isConfigured(): bool;

    public function supportsDevice(Device $device): bool;

    public function name(): string;

    /**
     * @return array{backups: list<array{id: string, date: ?int, until: ?int, type: string, content: ?string}>, total: int, totalPages: int, page: int}|null
     */
    public function backups(Device $device, int $page = 0): ?array;

    /**
     * @return array{id: string, date: ?int, until: ?int, type: string, content: ?string}|null
     */
    public function latest(Device $device): ?array;

    public function content(Device $device, string $backupId, int $pageHint = 0): ?string;

    /**
     * @return list<array{type: string, original: list<array{line: ?int, text: string}>, revised: list<array{line: ?int, text: string}>}>|null
     */
    public function diff(Device $device, string $origId, string $revId): ?array;

    public function lastError(): ?string;
}
