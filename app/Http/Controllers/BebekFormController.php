<?php

namespace App\Http\Controllers;

use App\Http\Requests\BebekFormRequest;
use App\Models\BebekForm;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class BebekFormController extends Controller
{
    public function index(Request $request)
    {
        $query = BebekForm::orderBy('created_at', 'desc');

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('cinsiyet', 'like', '%' . $request->q . '%')
                    ->orWhere('termin_durumu', 'like', '%' . $request->q . '%')
                    ->orWhere('kac_haftalik', 'like', '%' . $request->q . '%');
            });
        }

        if ($request->filled('cinsiyet')) {
            $query->where('cinsiyet', $request->cinsiyet);
        }

        $forms = $query->paginate(15)->withQueryString();

        return view('bebek.index', compact('forms'));
    }

    public function create()
    {
        return view('bebek.create');
    }

    public function store(BebekFormRequest $request)
    {
        BebekForm::create($request->validated());

        return redirect()->route('bebek.index')->with('success', 'Bebek formu kaydedildi.');
    }

    public function show(BebekForm $bebekForm)
    {
        return view('bebek.show', compact('bebekForm'));
    }

    public function exportPdf($id)
    {
        $bebekForm = BebekForm::findOrFail($id);
        $pdf = Pdf::loadView('bebek.pdf', ['bebekForm' => $bebekForm])
            ->setPaper('a4', 'portrait')
            ->setOptions(['defaultFont' => 'DejaVu Sans']);

        return $pdf->download('bebek-izlem-formu.pdf');
    }

    public function edit(BebekForm $bebekForm)
    {
        return view('bebek.edit', compact('bebekForm'));
    }

    public function update(BebekFormRequest $request, BebekForm $bebekForm)
    {
        $bebekForm->update($request->validated());

        return redirect()->route('bebek.index')->with('success', 'Bebek formu guncellendi.');
    }

    public function destroy(BebekForm $bebekForm)
    {
        $bebekForm->delete();

        return redirect()->route('bebek.index')->with('success', 'Bebek formu silindi.');
    }
}
