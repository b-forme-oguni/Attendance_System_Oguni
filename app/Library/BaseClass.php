<?php

namespace app\Library;

use App\Note;
use App\User;
use App\School;
use Illuminate\Support\Carbon;

class BaseClass
{
    // Formファザード用にSchoolクラスをidと名前の連想配列にする
    public static function schoolSelect()
    {
        $schoolselect = School::select('id', 'school_name')
        ->get()
        ->pluck('school_name','id');
        return $schoolselect;
    }

    // Formファザード用にUserクラスをidと名前の連想配列にする
    public static function usersList()
    {
        $users = User::all();
        $userslist = [];
        foreach ($users as $user) {
            $userslist += [
                $user->id => $user->id . '：' . $user->getName() . '（' . $user->school->getName() . '）',
            ];
        }
        return $userslist;
    }

    // Formファザード用にUserクラスをidと名前の連想配列にする
    public static function usersListScope($school_id)
    {
        $users = User::schoolIdEqual($school_id)->get();
        $userslist = [];
        foreach ($users as $user) {
            $userslist += [
                $user->id => $user->id . '：' . $user->getName(),
            ];
        }
        return $userslist;
    }

    // Formファザード用にNoteクラスをidと名前の連想配列にする
    public static function notesList()
    {
        $noteslist = Note::select('id','note')
            ->get()
            ->pluck('note', 'id');
        return $noteslist;
    }

    public static function timeTable()
    {
        // 9:30から16:00までの時間を15分単位で連想配列に格納
        $timetable = [];

        $start_time = Carbon::createFromTimeString('09:30:00');
        $end_time = Carbon::createFromTimeString('16:00:00');

        while ($start_time <= $end_time) {
            $key = date("H:i", strtotime($start_time->toTimeString()));
            $value = date("G時i分", strtotime($start_time->toTimeString()));
            $timetable += [
                $key => $value,
            ];
            $start_time->addMinutes(15);
        }

        return $timetable;
    }

    public static function toDayDate()
    {
        $todaydate = Carbon::now()->toDateString();
        return $todaydate;
    }
}
