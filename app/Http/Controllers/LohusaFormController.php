<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLohusaFormRequest;
use App\Models\LohusaForm;
use App\Repositories\LohusaFormRepository;
use App\Services\LohusaFormService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LohusaFormController extends Controller
{
    public function __construct(
        private readonly LohusaFormRepository $repository,
        private readonly LohusaFormService $service,
    ) {}

    public function index(Request $request): View
    {
        $this->authorize('viewAny', LohusaForm::class);

        return view('lohusa.index', [
            'forms' => $this->repository->paginate($request->only(['q', 'dogum_yeri', 'bebek_beslenmesi', 'postpartum_hafta_min', 'created_from', 'created_to'])),
            'filterOptions' => $this->repository->filterOptions(),
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', LohusaForm::class);

        return view('lohusa.create');
    }

    public function store(StoreLohusaFormRequest $request): RedirectResponse
    {
        $this->authorize('create', LohusaForm::class);
        $this->service->store($request->validated(), $request->user()->id);

        return redirect()
            ->route('lohusa.index')
            ->with('success', 'Form başarıyla kaydedildi.')
            ->with('clear_lohusa_draft', true);
    }

    public function exportCsv(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $this->authorize('viewAny', LohusaForm::class);

        $forms = $this->repository->paginate($request->only(['q', 'dogum_yeri', 'bebek_beslenmesi', 'postpartum_hafta_min', 'created_from', 'created_to']))->items();

        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\LohusaFormExport($forms), 'lohusa_disa_aktarim_' . now()->format('YmdHis') . '.xlsx');
    }

    public function show(LohusaForm $lohusaForm): View
    {
        $this->authorize('view', $lohusaForm);

        return view('lohusa.show', compact('lohusaForm'));
    }

    public function exportPdf(LohusaForm $lohusaForm): Response
    {
        $this->authorize('export', $lohusaForm);

        return $this->service->export($lohusaForm);
    }

    public function destroy(LohusaForm $lohusaForm): RedirectResponse
    {
        $this->authorize('delete', $lohusaForm);
        $this->service->destroy($lohusaForm);

        return redirect()->route('lohusa.index')->with('success', 'KayÄ±t silindi.');
    }
}
