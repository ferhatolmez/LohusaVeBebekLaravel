<?php

namespace App\Http\Controllers;

use App\Http\Requests\BebekFormRequest;
use App\Models\BebekForm;
use App\Repositories\BebekFormRepository;
use App\Services\BebekFormService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class BebekFormController extends Controller
{
    public function __construct(
        private readonly BebekFormRepository $repository,
        private readonly BebekFormService $service,
    ) {}

    public function index(Request $request): View
    {
        $this->authorize('viewAny', BebekForm::class);

        return view('bebek.index', [
            'forms' => $this->repository->paginate($request->only(['q', 'cinsiyet', 'termin_durumu', 'izlem_min', 'muayene_from', 'muayene_to'])),
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', BebekForm::class);

        return view('bebek.create');
    }

    public function store(BebekFormRequest $request): RedirectResponse
    {
        $this->authorize('create', BebekForm::class);
        $this->service->store($request->validated(), $request->user()->id);

        return redirect()->route('bebek.index')->with('success', 'Bebek formu kaydedildi.');
    }

    public function show(BebekForm $bebekForm): View
    {
        $this->authorize('view', $bebekForm);

        return view('bebek.show', compact('bebekForm'));
    }

    public function exportPdf(BebekForm $bebekForm): BinaryFileResponse
    {
        $this->authorize('export', $bebekForm);

        return $this->service->export($bebekForm);
    }

    public function edit(BebekForm $bebekForm): View
    {
        $this->authorize('update', $bebekForm);

        return view('bebek.edit', compact('bebekForm'));
    }

    public function update(BebekFormRequest $request, BebekForm $bebekForm): RedirectResponse
    {
        $this->authorize('update', $bebekForm);
        $this->service->update($bebekForm, $request->validated(), $request->user()->id);

        return redirect()->route('bebek.index')->with('success', 'Bebek formu güncellendi.');
    }

    public function destroy(BebekForm $bebekForm): RedirectResponse
    {
        $this->authorize('delete', $bebekForm);
        $this->service->destroy($bebekForm);

        return redirect()->route('bebek.index')->with('success', 'Bebek formu silindi.');
    }
}


