<?php

namespace App\Exports;

use App\Models\Rider;
use App\Contracts\Dao\Rider\RiderDaoInterface;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RidersExport implements FromCollection, WithHeadings
{
     /**
     * rider dao
     */
    private $riderDao;
    /**
     * Class Constructor
     * @param RiderDaoInterface $riderDao
     * @return void
     */
    public function __construct(RiderDaoInterface $riderDao)
    {
        $this->riderDao = $riderDao;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->riderDao->export();
    }

    public function headings(): array
    {
        return [
            'id',
            'name',
            'email',
            'phone',
            'address',
            'created_at',
            'updated_at'
        ];

    }
}
