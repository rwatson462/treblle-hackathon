<?php

namespace App\DataTransferObjects\Requests\Auth;

use App\Http\Requests\v1\Auth\RegisterRequest;

final readonly class RegisterRequestDto
{
    public string $name;
    public string $email;
    public string $password;

    public function __construct(RegisterRequest $request)
    {
        /** @var array<string,string> $data */
        $data = $request->validated();

        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->password = $data['password'];
    }

    /**
     * @return array<string,string>
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
