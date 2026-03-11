<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BebekFormExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping, WithStyles, WithEvents
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
            $form->cinsiyet,
            optional($form->dogum_tarihi)->format('d.m.Y') ?? '-',
            optional($form->muayene_tarihi)->format('d.m.Y') ?? '-',
            $form->izlem_sayisi,
            $form->termin_durumu,
            $form->completion_score . '%',
            $form->suggested_follow_up_date?->format('d.m.Y') ?? '-',
            $form->kac_haftalik,
            $form->kilo . ' kg',
            $form->boy . ' cm',
            $form->bas_cevresi . ' cm',
            $form->ates,
            $form->nabiz,
            $form->solunum,
            is_array($form->solunum_sistemi) ? implode(', ', $form->solunum_sistemi) : $form->solunum_sistemi,
            is_array($form->kas_iskelet) ? implode(', ', $form->kas_iskelet) : $form->kas_iskelet,
            is_array($form->norolojik) ? implode(', ', $form->norolojik) : $form->norolojik,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Cinsiyet',
            'Doğum Tarihi',
            'Muayene Tarihi',
            'İzlem Sayısı',
            'Termin Durumu',
            'Tamamlanma %',
            'Takip Tarihi',
            'Hafta',
            'Kilo',
            'Boy',
            'Baş Çevresi',
            'Ateş',
            'Nabız',
            'Solunum',
            'Solunum Sistemi',
            'Kas İskelet',
            'Nörolojik',
        ];
    }

    /**
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        $lastRow = count($this->forms) + 1;
        $lastColumn = 'R';

        // General text alignment
        $sheet->getStyle('A1:' . $lastColumn . $lastRow)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        // Center alignment for specific columns (ID, Dates, Numbers)
        $centerColumns = ['A', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O'];
        foreach ($centerColumns as $col) {
            $sheet->getStyle($col . '1:' . $col . $lastRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        }

        // Add subtle borders to all data
        $sheet->getStyle('A1:' . $lastColumn . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => 'D0D7DE'],
                ],
            ],
        ]);

        return [
            // Premium Header Styling
            1 => [
                'font' => [
                    'bold' => true, 
                    'color' => ['rgb' => 'FFFFFF'],
                    'size' => 11
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '0F766E'] // Deep Teal
                ],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]
            ],
        ];
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                // Freeze panes: Header row + ID column
                $sheet->freezePane('C2');
                
                // Set auto-filter for the whole range
                $lastColumn = 'R';
                $lastRow = count($this->forms) + 1;
                $sheet->setAutoFilter('A1:' . $lastColumn . '1');

                // Adjust row heights
                for ($i = 1; $i <= $lastRow; $i++) {
                    $sheet->getRowDimension($i)->setRowHeight(25);
                }
                $sheet->getRowDimension(1)->setRowHeight(35);
            },
        ];
    }
}
