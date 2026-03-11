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

class LohusaFormExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping, WithStyles, WithEvents
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
            $form->yas,
            $form->created_at->format('d.m.Y'),
            $form->risk_score,
            $form->risk_level,
            $form->completion_score . '%',
            $form->suggested_follow_up_date?->format('d.m.Y') ?? '-',
            $form->dogum_tarihi?->format('d.m.Y') ?? '-',
            $form->dogum_yeri,
            $form->egitim_durumu,
            $form->meslek,
            $form->postpartum_gun,
            $form->ates,
            $form->nabiz,
            $form->solunum,
            $form->tansiyon,
            $form->mevcut_kilo,
            is_array($form->psikolojik_belirtiler) ? implode(', ', $form->psikolojik_belirtiler) : $form->psikolojik_belirtiler,
            is_array($form->emzirme_bulgular) ? implode(', ', $form->emzirme_bulgular) : $form->emzirme_bulgular,
            $form->bebek_beslenmesi,
            $form->ebenin_yorumu,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Ad Soyad',
            'Yaş',
            'Kayıt Tarihi',
            'Risk Skoru',
            'Risk Seviyesi',
            'Tamamlanma %',
            'Takip Tarihi',
            'Doğum Tarihi',
            'Doğum Yeri',
            'Eğitim Durumu',
            'Meslek',
            'PP Gün',
            'Ateş',
            'Nabız',
            'Solunum',
            'Tansiyon',
            'Kilo',
            'Psikolojik Belirtiler',
            'Emzirme Bulguları',
            'Bebek Beslenmesi',
            'Ebenin Yorumu',
        ];
    }

    /**
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        $lastRow = count($this->forms) + 1;
        $lastColumn = 'V';
        
        // General text alignment for better visual harmony
        $sheet->getStyle('A1:' . $lastColumn . $lastRow)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        
        // Center alignment for specific columns (ID, Yas, Dates, Scores)
        $centerColumns = ['A', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'M', 'N', 'O', 'P', 'Q', 'R'];
        foreach ($centerColumns as $col) {
            $sheet->getStyle($col . '1:' . $col . $lastRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        }

        // Add subtle borders to all data
        $sheet->getStyle('A1:' . $lastColumn . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => 'D0D7DE'], // Subtle grey border
                ],
            ],
        ]);

        // Premium conditional styling for Risk Level column (F)
        for ($row = 2; $row <= $lastRow; $row++) {
            $riskLevel = $sheet->getCell('F' . $row)->getValue();
            $color = match($riskLevel) {
                'Yüksek Risk' => 'FEE2E2', // Soft Red
                'Orta Risk' => 'FEF3C7',  // Soft Yellow
                'Düşük Risk' => 'DCFCE7', // Soft Green
                default => 'FFFFFF'
            };
            
            if ($color !== 'FFFFFF') {
                $sheet->getStyle('F' . $row)->applyFromArray([
                    'font' => ['bold' => true, 'color' => ['rgb' => '1F2937']],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => $color]
                    ]
                ]);
            }
        }

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
                    'startColor' => ['rgb' => '1E293B'] // Deep Slate Blue
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
                $lastColumn = 'V';
                $lastRow = count($this->forms) + 1;
                $sheet->setAutoFilter('A1:' . $lastColumn . '1');

                // Adjust row heights for a more "breathable" design
                for ($i = 1; $i <= $lastRow; $i++) {
                    $sheet->getRowDimension($i)->setRowHeight(25);
                }
                $sheet->getRowDimension(1)->setRowHeight(35); // taller header
            },
        ];
    }
}
