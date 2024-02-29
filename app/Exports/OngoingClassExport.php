<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Style;
use Maatwebsite\Excel\Events\AfterSheet;

class OngoingClassExport implements FromView, WithTitle, WithDefaultStyles, WithEvents, WithHeadings
{
    public $classes;
    public $from;
    public function headings(): array
    {
        return [
            'asdasd',
            'asdasd',
            'asdasd',
            'asdasd',
            'asdasd',
            'asdasd',
            'asdasd',
            'asdasd',
            'asdasd',
            'asdasd',
            'asdasd',
            'asdasd',
            'asdasd',
            'asdasd',
            'asdasd',
            'asdasd',
            'asdasd',
            'asdasd',
            'asdasd',
            'asdasd',
            'asdasd',
            'asdasd',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $columns = range('A', 'Z');

                foreach ($columns as $column) {
                    $event->sheet->getDelegate()->getColumnDimension($column)->setAutoSize(true);
                }
            }
        ];
    }
    public function defaultStyles(Style $defaultStyle)
    {
        return [
            'alignment' => [
                'wrapText' => true,
            ],
        ];
    }
    public function title(): string
    {
        return 'Report';
    }
    public function __construct($classes, $from)
    {
        $this->classes = $classes;
        $this->from = $from;
    }
    public function view(): View
    {
        return view('export.ongoing-class', [
            'classes' => $this->classes,
            'from' => $this->from,
        ]);
    }
}
