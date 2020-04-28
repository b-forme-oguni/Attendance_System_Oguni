<?php

use App\Note;
use Illuminate\Database\Seeder;

class NotesTabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'note' => '通所',
        ];
        $notedata = new Note;
        $notedata->fill($param)->save();

        $param = [
            'note' => 'Skype',
        ];
        $notedata = new Note;
        $notedata->fill($param)->save();

        $param = [
            'note' => 'メール',
        ];
        $notedata = new Note;
        $notedata->fill($param)->save();

        $param = [
            'note' => '訪問',
        ];
        $notedata = new Note;
        $notedata->fill($param)->save();
    }
}
