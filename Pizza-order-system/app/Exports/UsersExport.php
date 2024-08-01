<?php

namespace App\Exports;

use App\Models\User;
use App\Contracts\Dao\UserDaoInterface;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Contracts\Services\UserServicesInterface;

class UsersExport implements FromCollection, WithHeadings
{

    private $userDao;

    /**
     * Class Constructor
     * @param UserServiceInterface
     * @return
     */
    public function __construct(UserServicesInterface $userInterface, $role)
    {
        $this->userInterface = $userInterface;
        $this->role = $role;
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->userInterface->export($this->role);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Phone Number',
            'Address',
            'Created at',
            'Updated at'
        ];
    }
}
