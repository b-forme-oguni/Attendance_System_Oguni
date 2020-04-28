<?php

use App\Admin;
use Illuminate\Database\Seeder;

class AdminsTabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'admin',
            'password' => 'testpass',
        ];
        $admindata = new Admin;
        $admindata->fill($param)->save();
    }
}
