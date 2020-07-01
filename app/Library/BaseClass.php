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
        $schools =  School::all();
        $schoolselect['0'] =  '全ての利用者';
        foreach ($schools as $school) {
            $schoolselect[$school->id] =  $school->getName();
        }
        return $schoolselect;
    }

    // Formファザード用にSchoolクラスをidと名前の連想配列にする
    public static function schoolsList()
    {
        $schools =  School::all();
        foreach ($schools as $school) {
            $schoolslist[$school->id] =  $school->getName();
        }
        return $schoolslist;
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
    public static function usersListScorp($school_id)
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
        $notes = Note::all();

        $noteslist = [];
        foreach ($notes as $note) {
            $noteslist += [
                $note->id => $note->note,
            ];
        }
        return $noteslist;
    }

    public static function timeTable()
    {
        // 9:30から16:00までの時間を15分単位で連想配列に格納
        $timetable = [];
        for ($i = 9 * 4; $i <= 16 * 4; $i++) {
            if ($i <= 16 * 3) {
                $key = date("H:i", strtotime("00:30 +" . $i * 15 . " minute"));
                $value = date("H時i分", strtotime("00:30 +" . $i * 15 . " minute"));
                $timetable += [
                    $key => $value,
                ];
            } else {
                $key = date("H:i", strtotime("00:00 +" . $i * 15 . " minute"));
                $value = date("H時i分", strtotime("00:00 +" . $i * 15 . " minute"));
                $timetable += [
                    $key => $value,
                ];
            }
        }
        return $timetable;
    }

    public static function toDayDate()
    {
        $todaydate = Carbon::now()->toDateString();
        return $todaydate;
    }
}
