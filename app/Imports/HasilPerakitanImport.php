<?php

namespace App\Imports;

use App\HasilPerakitan;
use Maatwebsite\Excel\Concerns\ToModel;

class HasilPerakitanImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new HasilPerakitan([
            //
        ]);
    }
}
