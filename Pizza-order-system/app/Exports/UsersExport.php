<?php

namespace App\Exports;

use App\Models\User;
use App\Contracts\Dao\UserDaoInterface;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{

    private $userDao;

    /**
     * Class Constructor
     * @param UserDaoInterface
     * @return
     */
    public function __construct(UserDaoInterface $userDaoInterface, $role)
    {
        $this->userDao = $userDaoInterface;
        $this->role = $role;
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->userDao->getAllUsers($this->role);
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
