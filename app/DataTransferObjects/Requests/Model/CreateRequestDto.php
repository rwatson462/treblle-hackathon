<?php

namespace App\DataTransferObjects\Requests\Model;

use App\Http\Requests\v1\Model\CreateRequest;

final readonly class CreateRequestDto
{
    public string $name;

    /**
     * @var array<string,string>
     */
    public array $attributes;

    public function __construct(CreateRequest $request)
    {
        /** @var array{name: string, attributes: array<string,string>} $data */
        $data = $request->validated();

        $this->name = $data['name'];
        $this->attributes = $data['attributes'];
    }

    /**
     * @return array{name: string, attributes: array<string,string>}
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'attributes' => $this->attributes,
        ];
    }
}
