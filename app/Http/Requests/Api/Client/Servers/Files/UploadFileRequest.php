<?php

namespace SneakyPanel\Http\Requests\Api\Client\Servers\Files;

use SneakyPanel\Models\Permission;
use SneakyPanel\Http\Requests\Api\Client\ClientApiRequest;

class UploadFileRequest extends ClientApiRequest
{
    public function permission(): string
    {
        return Permission::ACTION_FILE_CREATE;
    }
}
