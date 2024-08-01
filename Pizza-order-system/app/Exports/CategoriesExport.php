<?php

namespace App\Exports;

use App\Models\Category;
use App\Contracts\Dao\CategoryDaoInterface;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class CategoriesExport implements FromCollection, WithHeadings
{

    /**
     * category dao
     */
    private $categoryDao;
    /**
     * Class Constructor
     * @param CategoryDaoInterface $categoryDao
     * @return void
     */
    public function __construct(CategoryDaoInterface $categoryDao)
    {
        $this->categoryDao = $categoryDao;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->categoryDao->export();
    }

    public function headings(): array
    {
        return [
            'id',
            'name',
            'created_at',
            'updated_at'
        ];
    }
}
