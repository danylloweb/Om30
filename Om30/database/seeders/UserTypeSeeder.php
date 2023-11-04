<?php

namespace Database\Seeders;

use App\Entities\UserType;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    public function run()
    {
        $userTypes = [
            ['name' => 'Person'],
        ];
        foreach ($userTypes as $userType) {UserType::create($userType);}
    }
}
