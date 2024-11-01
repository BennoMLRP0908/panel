<?php

namespace SneakyPanel\Http\Requests\Api\Client\Servers\Files;

use SneakyPanel\Models\Permission;
use SneakyPanel\Contracts\Http\ClientPermissionsRequest;
use SneakyPanel\Http\Requests\Api\Client\ClientApiRequest;

class CopyFileRequest extends ClientApiRequest implements ClientPermissionsRequest
{
    public function permission(): string
    {
        return Permission::ACTION_FILE_CREATE;
    }

    public function rules(): array
    {
        return [
            'location' => 'required|string',
        ];
    }
}
