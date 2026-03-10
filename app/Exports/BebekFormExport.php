<?php

namespace App\Exports;

use App\Models\BebekForm;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BebekFormExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $forms;

    public function __construct($forms)
    {
        $this->forms = $forms;
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        return collect($this->forms);
    }

    /**
     * @param mixed $form
     * @return array
     */
    public function map($form): array
    {
        return [
            $form->id,
            $form->cinsiyet,
            optional($form->dogum_tarihi)->format('d.m.Y') ?? '-',
            optional($form->muayene_tarihi)->format('d.m.Y') ?? '-',
            $form->izlem_sayisi,
            $form->termin_durumu,
            $form->completion_score,
            $form->suggested_follow_up_date?->format('d.m.Y') ?? '-',
        ];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Cinsiyet',
            'Doğum Tarihi',
            'Muayene Tarihi',
            'İzlem Sayısı',
            'Termin Durumu',
            'Kalite Skoru',
            'Takip Tarihi'
        ];
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true], 'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => 'DDEBF7']]],
        ];
    }
}
