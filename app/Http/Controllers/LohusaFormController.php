<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLohusaFormRequest;
use App\Models\LohusaForm;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LohusaFormController extends Controller
{
    public function index(Request $request)
    {
        $query = LohusaForm::orderBy('created_at', 'desc');

        if ($request->filled('q')) {
            $query->where('ad_soyad', 'like', '%' . $request->q . '%');
        }

        $forms = $query->paginate(15)->withQueryString();

        return view('lohusa.index', compact('forms'));
    }

    public function create()
    {
        return view('lohusa.create');
    }

    public function store(StoreLohusaFormRequest $request)
    {
        LohusaForm::create($request->validated());

        return redirect()->route('lohusa.index')->with('success', 'Form basariyla kaydedildi.');
    }

    public function show(LohusaForm $lohusaForm)
    {
        return view('lohusa.show', compact('lohusaForm'));
    }

    public function exportPdf($id)
    {
        $lohusa = LohusaForm::findOrFail($id);
        $pdf = Pdf::loadView('lohusa.pdf', compact('lohusa'))
            ->setPaper('a4', 'portrait')
            ->setOptions(['defaultFont' => 'DejaVu Sans']);

        return $pdf->download('lohusa-izlem-formu.pdf');
    }

    public function destroy($id)
    {
        LohusaForm::destroy($id);

        return redirect()->route('lohusa.index')->with('success', 'Kayit silindi.');
    }
}
