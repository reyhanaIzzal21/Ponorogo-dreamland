<?php

namespace App\Exports;

use App\Contracts\Interfaces\ReservationRepositoryInterface;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ReservationExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithColumnFormatting
{
    protected array $filters;
    protected ReservationRepositoryInterface $reservationRepository;

    public function __construct(array $filters, ReservationRepositoryInterface $reservationRepository)
    {
        $this->filters = $filters;
        $this->reservationRepository = $reservationRepository;
    }

    /**
     * Return collection of reservations to export (order preserved).
     */
    public function collection()
    {
        return $this->reservationRepository->getFilteredForExport($this->filters);
    }

    /**
     * Headings in the Excel file (column order).
     */
    public function headings(): array
    {
        return [
            'Nama',
            'Destinasi',
            'WhatsApp',
            'Tanggal Reservasi',
            'Jumlah Orang',
            'Kebutuhan',
            'Catatan'
        ];
    }

    /**
     * Map each reservation to a row (keeps column order).
     * For date, convert to Excel serial so formatting works.
     */
    public function map($reservation): array
    {
        return [
            $reservation->user_name,
            optional($reservation->destination)->name,
            "'" . $reservation->user_whatsapp,
            $reservation->reservation_date ? ExcelDate::dateTimeToExcel($reservation->reservation_date) : null,
            $reservation->number_of_people,
            $reservation->needs,
            $reservation->notes,
        ];
    }

    /**
     * Basic styles: bold header + subtle fill.
     */
    public function styles(Worksheet $sheet)
    {
        // Header row style
        $sheet->getStyle('A1:G1')->getFont()->setBold(true);
        $sheet->getStyle('A1:G1')->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setRGB('F3F4F6');

        // Optional: center-align header
        $sheet->getStyle('A1:G1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        return [];
    }

    /**
     * Column formatting: D => reservation date (Excel date format).
     * Use dd-mm-yyyy style (or change to whichever you prefer).
     */
    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_TEXT,              // WhatsApp
            'D' => NumberFormat::FORMAT_DATE_DDMMYYYY, // dd-mm-yyyy
        ];
    }
}
