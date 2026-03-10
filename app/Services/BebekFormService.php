<?php

namespace App\Services;

use App\Models\BebekForm;
use App\Repositories\BebekFormRepository;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class BebekFormService
{
    public function __construct(
        private readonly BebekFormRepository $repository,
        private readonly PdfService $pdfService,
    ) {}

    public function store(array $attributes, int $userId): BebekForm
    {
        $attributes['created_by'] = $userId;
        $attributes['updated_by'] = $userId;

        return $this->repository->create($attributes);
    }

    public function update(BebekForm $bebekForm, array $attributes, int $userId): BebekForm
    {
        $attributes['updated_by'] = $userId;

        return $this->repository->update($bebekForm, $attributes);
    }

    public function destroy(BebekForm $bebekForm): void
    {
        $this->repository->delete($bebekForm);
    }

    public function export(BebekForm $bebekForm): BinaryFileResponse
    {
        return $this->pdfService->download('bebek.pdf', ['bebekForm' => $bebekForm], 'bebek-izlem-formu.pdf');
    }
}
