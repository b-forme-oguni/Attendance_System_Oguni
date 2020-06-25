<?php

namespace App\Http\Controllers;

use App\Performance;
use app\Library\BaseClass;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ExportController extends Controller
{

    // 実績記録
    public function index(Request $request)
    {
        // リクエストにschool_idがない場合、１（本校）を取得
        if ($request->has('school_id')) {
            $school_id = $request->school_id;
        } else {
            $school_id = 1;
        }
        // リクエストにyear_monthがない場合、Carbonから今の年月を取得
        if ($request->has('year_month')) {
            $year_month = $request->year_month;
        } else {
            $year_month = Carbon::now()->format('Y-m');
        }

        // リクエストまたはCarbonから取得した年月を、 $yearと$monthに分ける
        $year = date('Y', strtotime($year_month));
        $month = date('m', strtotime($year_month));

        // Performanceテーブルのレコードより、
        //     1. insert_dateの年が一致
        //     2. insert_dateの月が一致
        //     3.リレーションしているUserより、所属校がリクエストと一致
        //     4. user_idが重複しない一意のもの
        //     5. user_idの昇順
        //     6.ペジネートで80区切り
        // で取得
        $records = Performance::whereYear('insert_date', $year)
            ->whereMonth('insert_date', $month)
            ->whereHas('User', function ($q) use ($school_id) {
                $q->where('school_id', $school_id);
            })
            ->groupBy('user_id')
            ->orderBy('user_id')
            ->with(['user', 'school'])
            ->paginate(80);

        $param = [
            'records' => $records,
            'schoolselect' => BaseClass::schoolsList(),
            'school_id' =>  $school_id,
            'year_month' => $year_month,
        ];

        return view('export.exportlist', $param);
    }

    // 実績記録
    public function preview(Request $request)
    {
        $user_id = $request->id;
        $year_month = $request->date;

        // リクエストまたはCarbonから取得した年月を、 $yearと$monthに分ける
        $year = date('Y', strtotime($year_month));
        $month = date('m', strtotime($year_month));

        // Performanceテーブルのレコードより、
        //     1. user_idが一致
        //     2. insert_dateの年が一致
        //     3. insert_dateの月が一致
        //     4. insert_dateの昇順
        // で取得
        $records = Performance::where('user_id', $user_id)
            ->whereYear('insert_date', $year)
            ->whereMonth('insert_date', $month)
            ->with(['user', 'note'])
            ->orderBy('insert_date')
            ->get()->toArray();

        $dateArray = array_column($records, 'insert_date');

        $monthday = new Carbon($year_month);

        $exceltables = [];

        $totalday = $monthday->daysInMonth;
        for ($i = 0; $i < $totalday; $i++) {
            $day = new Carbon($monthday);

            $result = array_search($monthday->toDateString(), $dateArray);

            if ($result !== false) {
                $record = $records[$result];
            } else {
                $record = null;
            }

            $exceltable = new \app\Library\ExcelTable($day, $record);

            $exceltables[] = $exceltable;
            $monthday->addDay();
        }

        $param = [
            'exceltables' => $exceltables,
        ];

        return view('export.perf_preview', $param);
    }


    // 実務記録表をExcelで出力
    public function export(Request $request)
    {
        $user_id = $request->id;
        $year_month = $request->date;

        // リクエストから取得した年月を、 $yearと$monthに分ける
        $year = date('Y', strtotime($year_month));
        $month = date('m', strtotime($year_month));

        // UserIDと年月で絞り込んだ実務記録レコードを取得
        $records = Performance::where('user_id', $user_id)
            ->whereYear('insert_date', $year)
            ->whereMonth('insert_date', $month)
            ->with(['user', 'note'])->get();







        $view = view('export.performanceexport', compact('records'));
        return Excel::download(new UsersExport($view), 'users.xlsx');
    }
}
