<?php

namespace SneakyPanel\Http\Requests\Api\Client\Servers\Subusers;

use SneakyPanel\Models\Permission;

class DeleteSubuserRequest extends SubuserRequest
{
    public function permission(): string
    {
        return Permission::ACTION_USER_DELETE;
    }
}
