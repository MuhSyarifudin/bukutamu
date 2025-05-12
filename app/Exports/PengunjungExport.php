<?php

namespace App\Exports;

use App\Models\Acara;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\Pengunjung;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;

class PengunjungExport implements FromCollection,WithHeadings,WithStyles,ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $pengunjung;
    protected $acara_id;
    protected $profit;
    protected $acara;

    public function __construct($acara_id)
    {
        $this->acara_id = $acara_id;
        $this->acara = Acara::findOrFail($acara_id);
        $this->profit = Pengunjung::where('acara_id',$acara_id)->sum('uang');
        $this->pengunjung = Pengunjung::where('acara_id',$acara_id)->count();
    }

    public function collection()
    {
        
        $this->acara = Acara::findOrFail($this->acara_id);
        
        return Pengunjung::select('nama','alamat','no_telp','uang','status')->where('acara_id',$this->acara_id)->get()
        ->map(function ($item) {
            return [
                'nama' => $item->nama,
                'alamat' => $item->alamat,
                'no_telp' => $item->no_telp,
                'uang' => $item->uang,
                'status' => $item->status == 1 ? 'Lunas' : 'Belum Lunas',
            ];
        });;

    }

    public function headings(): array
    {
        return ['Nama','Alamat','No. Telepon','Uang','Status'];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {

                  // Sisipkan 4 baris kosong di atas — agar heading & data mulai dari baris ke-5
                $event->sheet->insertNewRowBefore(1, 1);

                $date_to_string = strtotime($this->acara->tanggal);
                // Tambahkan teks di A1
                $event->sheet->setCellValue('A1', 'Acara: ' . $this->acara->nama . ' | Tanggal: ' . date('d-m-Y',$date_to_string).'| Profit: '.rupiah($this->profit).'| Pengunjung: '.$this->pengunjung.' Orang');

                // Merge cell A1 sampai C1 (menyesuaikan jumlah kolom)
                $event->sheet->mergeCells('A1:G1');

                // Bold dan ukuran font
                $event->sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                    ],
                ]);

                 // Hitung jumlah data
                $dataCount = Pengunjung::where('acara_id', $this->acara_id)->count();

                // Mulai dari baris 5 (heading), lalu baris 6 sampai ... (jumlah data)
                $startRow = 2;
                $endRow = $startRow + $dataCount;

                 // Tentukan kolom (misal: A sampai E)
                $cellRange = "A{$startRow}:E{$endRow}";

                  // Terapkan border ke semua sisi
                $event->sheet->getStyle($cellRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);

            }
        ];
    }
}
