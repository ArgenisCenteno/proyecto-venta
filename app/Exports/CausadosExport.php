<?php

namespace App\Exports;

use App\Models\Causado;
use Maatwebsite\Excel\Concerns\FromCollection;

class CausadosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Causado::all();
    }
}
