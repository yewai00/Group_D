<?php

namespace App\Imports;

use App\Models\Rider;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RidersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Rider([
            'name'=>$row['name'],
            'email'=>$row['email'],
            'phone'=>$row['phone'],
            'address'=>$row['address']
        ]);
    }
}
