<?php

namespace SneakyPanel\Http\Requests\Api\Client\Account;

use SneakyPanel\Models\User;
use Illuminate\Container\Container;
use Illuminate\Contracts\Hashing\Hasher;
use SneakyPanel\Http\Requests\Api\Client\ClientApiRequest;
use SneakyPanel\Exceptions\Http\Base\InvalidPasswordProvidedException;

class UpdateEmailRequest extends ClientApiRequest
{
    /**
     * @throws \SneakyPanel\Exceptions\Http\Base\InvalidPasswordProvidedException
     */
    public function authorize(): bool
    {
        if (!parent::authorize()) {
            return false;
        }

        $hasher = Container::getInstance()->make(Hasher::class);

        // Verify password matches when changing password or email.
        if (!$hasher->check($this->input('password'), $this->user()->password)) {
            throw new InvalidPasswordProvidedException(trans('validation.internal.invalid_password'));
        }

        return true;
    }

    public function rules(): array
    {
        $rules = User::getRulesForUpdate($this->user());

        return ['email' => $rules['email']];
    }
}
