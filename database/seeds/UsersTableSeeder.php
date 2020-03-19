<?php

use Illuminate\Database\Seeder;
use App\Requests\Maravel as Request;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'زبان‌زد',
                'type' => 'system',
                'status' => 'blocked',
            ],
            [
                'username' => 'admin',
                'name' => 'Admin',
                'type' => 'admin',
                'status' => 'active',
                'password' => Hash::make('hasan@1301$#@asdf')
            ],
            [
                'username' => 'hasan',
                'mobile' => '989356032043',
                'email' => 'itb.baravak@gmail.com',
                'name' => 'محمدحسن صالحی',
                'type' => 'admin',
                'status' => 'active',
                'password' => Hash::make('hasan110115116')
            ],
            [
                'username' => 'hamed',
                'mobile' => '989177187452',
                'name' => 'حامد معدل',
                'type' => 'admin',
                'status' => 'active',
                'password' => Hash::make('hamed110115116')
            ],
            [
                'username' => 'mohammad',
                'mobile' => '989196921786',
                'name' => 'سیدمحمد سیدآقامیری',
                'type' => 'admin',
                'status' => 'active',
                'password' => Hash::make('mohammad110115116')
            ]
        ];
        foreach ($users as $key => $value) {
            $request = new Request($value);
            $controller = new UserController($request);
            $controller->store($request);
        }
    }
}
