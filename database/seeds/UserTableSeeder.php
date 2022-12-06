<?php

use Illuminate\Database\Seeder;
use App\Admin;
use App\Roles;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();

        $adminRoles = Roles::where('name','admin')->first();
        $authorRoles = Roles::where('name','author')->first();
        $userRoles = Roles::where('name','user')->first();

        $admin = Admin::create([
			'admin_name' => 'phuvuong2107',
			'admin_email' => 'phuvuong753@gmail.com',
			'admin_phone' => '0965877244',
			'admin_password' => md5('123456')	
        ]);
        $author = Admin::create([
			'admin_name' => 'phuvuong210720',
			'admin_email' => 'phuvuong200@gmail.com',
			'admin_phone' => '0965877244',
			'admin_password' => md5('123456')	
        ]);
        $user = Admin::create([
			'admin_name' => 'phuvuong21072000',
			'admin_email' => 'phuvuong2107@gmail.com',
			'admin_phone' => '0965877244',
			'admin_password' => md5('123456')
        ]);
        $admin->roles()->attach($adminRoles);
        $author->roles()->attach($authorRoles);
        $user->roles()->attach($userRoles);
    }
}
