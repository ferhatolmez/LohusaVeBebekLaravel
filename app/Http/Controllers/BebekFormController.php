<?php

namespace App\Http\Controllers;

use App\Http\Requests\BebekFormRequest;
use App\Models\BebekForm;
use App\Repositories\BebekFormRepository;
use App\Services\BebekFormService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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

    public function exportCsv(Request $request): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        $this->authorize('viewAny', BebekForm::class);

        $forms = $this->repository->paginate($request->only(['q', 'cinsiyet', 'termin_durumu', 'izlem_min', 'muayene_from', 'muayene_to']))->items();

        return response()->streamDownload(function () use ($forms) {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF)); // UTF-8 BOM
            fputcsv($handle, ['ID', 'Cinsiyet', 'Doğum Tarihi', 'Muayene Tarihi', 'İzlem Sayısı', 'Termin Durumu', 'Kalite Skor', 'Takip Tarihi']);
            foreach ($forms as $form) {
                fputcsv($handle, [
                    $form->id, $form->cinsiyet, optional($form->dogum_tarihi)->format('d.m.Y'),
                    optional($form->muayene_tarihi)->format('d.m.Y'), $form->izlem_sayisi,
                    $form->termin_durumu, $form->completion_score,
                    $form->suggested_follow_up_date?->format('d.m.Y') ?? '-',
                ]);
            }
            fclose($handle);
        }, 'bebek_disa_aktarim_' . now()->format('YmdHis') . '.csv');
    }

    public function show(BebekForm $bebekForm): View
    {
        $this->authorize('view', $bebekForm);

        return view('bebek.show', compact('bebekForm'));
    }

    public function exportPdf(BebekForm $bebekForm): Response
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
