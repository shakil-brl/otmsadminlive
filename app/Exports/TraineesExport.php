<?php

namespace App\Exports;

use App\Http\Clients\ApiHttpClient;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Style;
use Maatwebsite\Excel\Events\AfterSheet;

class TraineesExport implements FromView, WithTitle, WithDefaultStyles, WithEvents, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $batch_id, $trainees;

    public function __construct($batch_id)
    {
        $this->batch_id = $batch_id;
        $this->trainees = [];

        $results = ApiHttpClient::request('get', 'detail/trainee-total', [
            'batch_id' => $this->batch_id,
            'per_page' => 100,
        ])->json();

        if ($results['success'] == true) {
            $data = $results['data']['data'] ?? [];

            $this->trainees = $data;
        }
    }

    public function headings(): array
    {
        return [
            'Test',
            'Test',
            'Test',
            'Test',
            'Test',
            'Test',
            'Test',
            'Test',
            'Test',
            'Test',
            'Test',
            'Test',
            'Test',
            'Test',
            'Test',
            'Test',
            'Test',
            'Test',
            'Test',
            'Test',
            'Test',
            'Test',
            'Test',
            'Test',
            'Test',
            'Test',
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

    public function view(): View
    {
        return view('trainees.export', [
            'trainees' => $this->trainees,
        ]);
    }
}
