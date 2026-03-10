<?php

namespace App\Services;

use App\Models\LohusaForm;
use App\Repositories\LohusaFormRepository;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class LohusaFormService
{
    public function __construct(
        private readonly LohusaFormRepository $repository,
        private readonly PdfService $pdfService,
    ) {}

    public function store(array $attributes, int $userId): LohusaForm
    {
        $attributes['created_by'] = $userId;
        $attributes['updated_by'] = $userId;

        return $this->repository->create($attributes);
    }

    public function update(LohusaForm $lohusaForm, array $attributes, int $userId): LohusaForm
    {
        $attributes['updated_by'] = $userId;

        return $this->repository->update($lohusaForm, $attributes);
    }

    public function destroy(LohusaForm $lohusaForm): void
    {
        $this->repository->delete($lohusaForm);
    }

    public function export(LohusaForm $lohusaForm): BinaryFileResponse
    {
        return $this->pdfService->download('lohusa.pdf', ['lohusa' => $lohusaForm], 'lohusa-izlem-formu.pdf');
    }
}
