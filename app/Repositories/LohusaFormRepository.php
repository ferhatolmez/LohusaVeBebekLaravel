<?php

namespace App\Repositories;

use App\Models\LohusaForm;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class LohusaFormRepository
{
    public function paginate(array $filters, int $perPage = 15): LengthAwarePaginator
    {
        return LohusaForm::query()->latest()->filter($filters)->paginate($perPage)->withQueryString();
    }

    public function apiPaginate(array $filters, int $perPage = 15): LengthAwarePaginator
    {
        return LohusaForm::query()->latest()->filter($filters)->paginate($perPage);
    }

    public function create(array $attributes): LohusaForm
    {
        return LohusaForm::query()->create($attributes);
    }

    public function update(LohusaForm $lohusaForm, array $attributes): LohusaForm
    {
        $lohusaForm->update($attributes);

        return $lohusaForm->refresh();
    }

    public function delete(LohusaForm $lohusaForm): void
    {
        $lohusaForm->delete();
    }

    public function filterOptions(): array
    {
        return \Illuminate\Support\Facades\Cache::remember('lohusa_filter_options', 60, function () {
            return [
                'dogumYerleri' => LohusaForm::query()->whereNotNull('dogum_yeri')->distinct()->orderBy('dogum_yeri')->pluck('dogum_yeri'),
                'bebekBeslenmeSekilleri' => LohusaForm::query()->whereNotNull('bebek_beslenmesi')->distinct()->orderBy('bebek_beslenmesi')->pluck('bebek_beslenmesi'),
            ];
        });
    }

    public function latest(int $limit = 4): Collection
    {
        return LohusaForm::query()->latest()->limit($limit)->get();
    }

    public function allLatest(): Collection
    {
        return LohusaForm::query()->latest()->get();
    }
}
