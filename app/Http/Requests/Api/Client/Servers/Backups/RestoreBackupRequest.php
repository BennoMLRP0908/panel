<?php

namespace SneakyPanel\Http\Requests\Api\Client\Servers\Backups;

use SneakyPanel\Models\Permission;
use SneakyPanel\Http\Requests\Api\Client\ClientApiRequest;

class RestoreBackupRequest extends ClientApiRequest
{
    public function permission(): string
    {
        return Permission::ACTION_BACKUP_RESTORE;
    }

    public function rules(): array
    {
        return ['truncate' => 'required|boolean'];
    }
}
