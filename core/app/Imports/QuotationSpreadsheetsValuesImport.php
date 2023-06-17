<?php

namespace App\Imports;

use App\Models\QuotationSpreadsheetsValues;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\HeadingRowImport;

class QuotationSpreadsheetsValuesImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        echo "<pre>";
        print_r($row);
        echo "</pre>";
        exit();

        /*
        if (!isset($row[0])) {
            return null;
        }
        */
        return new QuotationSpreadsheetsValues([
            /*
            'distrito_code' => $row['c_cod_distrito'],
            'distrito_nombre' => $row['c_nom_distrito'],
            'provincia_code' => $row['c_cod_provincia'],
            'provincia_nombre' => $row['c_nom_provincia'],
            'departamento_code' => $row['c_cod_departamento'],
            'departamento_nombre' => $row['c_nom_departamento'],
            'min_amount' => $row['monto_minimo_s/1600'],
            'max_amount' => $row['monto_delivery'],
            */
            
            'distrito_code' => $row[0],
            'distrito_nombre' => $row[1],
            'provincia_code' => $row[2],
            'provincia_nombre' => $row[3],
            'departamento_code' => $row[4],
            'departamento_nombre' => $row[5],
            'min_amount' => $row[6],
            'max_amount' => $row[7],
            
        ]);
    }
    public function batchSize(): int
    {
        return 100;
    }
    public function chunkSize(): int
    {
        return 100;
    }
}
