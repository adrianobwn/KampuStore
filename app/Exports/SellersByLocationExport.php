<?php

namespace App\Exports;

use App\Models\Seller;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\DB;

class SellersByLocationExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $selectedLocation = $this->request->get('location');
        $query = Seller::where('status', 'approved')->whereNotNull('provinsi');

        if ($selectedLocation) {
            $query->where('provinsi', $selectedLocation)->orderBy('nama_toko', 'asc');
        } else {
            $query->orderBy('provinsi', 'asc');
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Toko',
            'Nama PIC',
            'Provinsi'
        ];
    }

    public function map($seller): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $seller->nama_toko,
            $seller->nama_pic,
            $seller->provinsi
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
