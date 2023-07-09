<?php

namespace App\DataTransferObjects\Requests;

use App\Http\Requests\v1\Auth\LoginRequest;

readonly class LoginRequestDto
{
    public string $email;
    public string $password;

    public function __construct(LoginRequest $request) {

        /** @var array<string,string> $data */
        $data = $request->validated();

        $this->email = $data['email'];
        $this->password = $data['password'];
    }

    /**
     * @return array<string,string>
     */
    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
