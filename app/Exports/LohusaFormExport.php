<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LohusaFormExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping, WithStyles
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
     * @param  mixed  $form
     */
    public function map($form): array
    {
        return [
            $form->id,
            $form->ad_soyad,
            $form->created_at->format('d.m.Y'),
            $form->risk_score,
            $form->risk_level,
            $form->completion_score,
            $form->suggested_follow_up_date?->format('d.m.Y') ?? '-',
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Ad Soyad',
            'Tarih',
            'Risk Skoru',
            'Risk Seviyesi',
            'Kalite Skoru',
            'Takip Tarihi',
        ];
    }

    /**
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true], 'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => 'E2EFDA']]],
        ];
    }
}
