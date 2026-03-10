<?php

namespace App\Repositories;

use App\Models\BebekForm;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class BebekFormRepository
{
    public function paginate(array $filters, int $perPage = 15): LengthAwarePaginator
    {
        return BebekForm::query()
            ->latest()
            ->filter($filters)
            ->paginate($perPage)
            ->withQueryString();
    }

    public function apiPaginate(array $filters, int $perPage = 15): LengthAwarePaginator
    {
        return BebekForm::query()
            ->latest()
            ->filter($filters)
            ->paginate($perPage);
    }

    public function create(array $attributes): BebekForm
    {
        return BebekForm::query()->create($attributes);
    }

    public function update(BebekForm $bebekForm, array $attributes): BebekForm
    {
        $bebekForm->update($attributes);

        return $bebekForm->refresh();
    }

    public function delete(BebekForm $bebekForm): void
    {
        $bebekForm->delete();
    }

    public function latest(int $limit = 4): Collection
    {
        return BebekForm::query()->latest()->limit($limit)->get();
    }

    public function allLatest(): Collection
    {
        return BebekForm::query()->latest()->get();
    }
}
