<?php

namespace LibreNMS\Interfaces\Plugins;

use App\Models\Device;

/**
 * Optional capability for a ConfigBackupProvider that can be asked to queue a
 * fresh backup of a device (for example Oxidized's "reload node" or rConfig's
 * "download now").
 */
interface RefreshableConfigBackupProvider
{
    /**
     * Queue a fresh backup of the device with the provider.
     *
     * @param  string  $requestedBy  user requesting the refresh, for the provider's audit trail
     * @return bool whether the request was accepted
     */
    public function refresh(Device $device, string $requestedBy): bool;
}
