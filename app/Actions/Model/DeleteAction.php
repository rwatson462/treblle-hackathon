<?php

namespace App\Actions\Model;

use App\Repositories\HeadlessModelRepository;

final readonly class DeleteAction
{
    public function __construct(
        private readonly HeadlessModelRepository $repository,
    ) {
        //
    }

    public function execute(string $modelId): void
    {
        $this->repository->findById($modelId)->delete();
    }
}
