<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Contracts\Services\PizzaServicesInterface;

class PizzasExport implements FromCollection, WithHeadings
{
    private $pizzaInterface;

    /**
     * Class constructor
     * @param PizzaServicesInterface
     * @return
     */
    public function __construct(PizzaServicesInterface $pizzaServicesInterface)
    {
        $this->pizzaInterface = $pizzaServicesInterface;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->pizzaInterface->export();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Image',
            'Category',
            'Buy One Get One',
            'Price',
            'Description',
            'Created at',
            'Updated at'
        ];
    }
}
