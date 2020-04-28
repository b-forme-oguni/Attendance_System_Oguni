<?php

use App\School;
use Illuminate\Database\Seeder;

class SchoolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'school_name' => '本校',
        ];
        $schooldata = new School;
        $schooldata->fill($param)->save();

        $param = [
            'school_name' => '本町2校',
        ];
        $schooldata = new School;
        $schooldata->fill($param)->save();
    }
}
