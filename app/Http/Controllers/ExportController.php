<?php

namespace App\Http\Controllers;

use App\User;
use App\Performance;
use app\Library\BaseClass;
use app\Library\ExcelTable;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    // Excel出力プレビューを表示
    public function preview(Request $request)
    {
        // リクエストにschool_idがない場合、NULL
        if ($request->has('school_id')) {
            $school_id = $request->school_id;
        } else {
            $school_id = null;
        }
        // リクエストにuser_idがない場合、NULL
        if ($request->has('user_id')) {
            $user_id = $request->user_id;
        } else {
            $user_id = null;
        }
        // リクエストにyear_monthがない場合、現在の年月を取得
        if ($request->has('year_month')) {
            $year_month = $request->year_month;
        } else {
            $year_month = Carbon::now()->format('Y-m');
        }

        $user = User::where('id', $user_id)->first();

        // リクエストから取得した年月を、 $yearと$monthに分ける
        $year = date('Y', strtotime($year_month));
        $month = date('n', strtotime($year_month));

        // Performanceテーブルのレコードより、
        //     1. user_idが一致
        //     2. insert_dateの年が一致
        //     3. insert_dateの月が一致
        //     4. insert_dateの昇順
        //     5. getしたものを連想配列に変換
        // で取得
        $records = Performance::where('user_id', $user_id)
            ->whereYear('insert_date', $year)
            ->whereMonth('insert_date', $month)
            ->with('note')
            ->orderBy('insert_date')
            ->get()
            ->toArray();

        // recordsレコードセットからinsert_dateキーを配列番号で取得
        $dateArray = array_column($records, 'insert_date');
        // リクエストから取得した年月からCarbonインスタンスを取得
        $monthdays = new Carbon($year_month);
        // viewに渡すexceltables配列を宣言
        $exceltables = [];
        // 指定された月の日数を取得
        $totalday = $monthdays->daysInMonth;

        // 月の日数分、exceltables配列にExcelTableインスタンスを入れる
        for ($i = 0; $i < $totalday; $i++) {
            // 指定月の１日から末日までのCarbonインスタンスを生成
            $day = new Carbon($monthdays);

            // Performanceレコードから抽出したinsert_dateの値と、
            // Carbonインスタンス（１日から末日）の日付を比較
            // 一致の場合は配列番号、不一致の場合はfalseを返す
            $result = array_search($monthdays->toDateString(), $dateArray);
            if ($result !== false) {
                // 一致：recordsから日付の一致する配列番号を指定してrecordに代入
                $record = $records[$result];
            } else {
                // 不一致：recordにNULLを代入
                $record = null;
            }

            // ExcelTableインスタンスを生成
            $exceltable = new ExcelTable($day, $record);
            // ExcelTableインスタンスを配列に格納
            $exceltables[] = $exceltable;
            // Carbonクラスの日付を１日プラス
            $monthdays->addDay();
        }

        $param = [
            'user_id' =>  $user_id,
            'school_id' =>  $school_id,
            'year_month' => $year_month,
            'user' => $user,
            'exceltables' => $exceltables,
            'schoolselect' => BaseClass::schoolSelect(),
            'userslist' => BaseClass::usersListScope($school_id),
        ];

        return view('export.preview', $param);
    }


    // 実務記録表をExcelで出力
    public function export(Request $request)
    {
        $user_id = $request->id;
        $user = User::where('id', $user_id)->first();

        $year_month = $request->date;

        // リクエストから取得した年月を、 $yearと$monthに分ける
        $year = date('Y', strtotime($year_month));
        $month = date('n', strtotime($year_month));

        // Performanceテーブルのレコードより、
        //     1. user_idが一致
        //     2. insert_dateの年が一致
        //     3. insert_dateの月が一致
        //     4. insert_dateの昇順
        //     5. getしたものを連想配列に変換
        // で取得
        $records = Performance::where('user_id', $user_id)
            ->whereYear('insert_date', $year)
            ->whereMonth('insert_date', $month)
            ->with('note')
            ->orderBy('insert_date')
            ->get()
            ->toArray();

        // recordsレコードセットからinsert_dateキーを配列番号で取得
        $dateArray = array_column($records, 'insert_date');
        // リクエストから取得した年月からCarbonインスタンスを取得
        $monthday = new Carbon($year_month);
        // viewに渡すexceltables配列を宣言
        $exceltables = [];
        // 指定された月の日数を取得
        $totalday = $monthday->daysInMonth;

        // 月の日数分、exceltables配列にExcelTableインスタンスを入れる
        for ($i = 0; $i < $totalday; $i++) {
            // 指定月の１日から末日までのCarbonインスタンスを生成
            $day = new Carbon($monthday);

            // Performanceレコードから抽出したinsert_dateの値と、
            // Carbonインスタンス（１日から末日）の日付を比較
            // 一致の場合は配列番号、不一致の場合はfalseを返す
            $result = array_search($monthday->toDateString(), $dateArray);
            if ($result !== false) {
                // 一致：recordsから日付の一致する配列番号を指定してrecordに代入
                $record = $records[$result];
            } else {
                // 不一致：recordにNULLを代入
                $record = null;
            }

            // ExcelTableインスタンスを生成
            $exceltable = new ExcelTable($day, $record);
            // ExcelTableインスタンスを配列に格納
            $exceltables[] = $exceltable;
            // Carbonクラスの日付を１日プラス
            $monthday->addDay();
        }

        $param = [
            'user' => $user,
            'year_month' => $year_month,
            'exceltables' => $exceltables,
        ];

        $view = view('export.export', compact('user', 'year_month', 'exceltables'));
        return Excel::download(new UsersExport($view), $year_month . '_' . $user->getNameFull() . '.xlsx');
    }
}
