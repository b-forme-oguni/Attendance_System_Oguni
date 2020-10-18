<?php

namespace App\Http\Controllers;

use App\User;
use App\Performance;
use app\Library\BaseClass;
use app\Library\ExcelTable;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared;
use Madnest\Madzipper\Facades\Madzipper;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

        if(isset($user_id)){
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


    // 利用者１件の実務記録表をExcelで出力
    public function export(Request $request)
    {
        $user_id = $request->user_id;
        $user = User::where('id', $user_id)->first();
        $year_month = $request->date;

        $records = Performance::where('user_id', $user_id)
            ->whereYear('insert_date', date('Y', strtotime($year_month)))
            ->whereMonth('insert_date', date('n', strtotime($year_month)))
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
            // Performanceレコードから抽出したinsert_dateの値と、Carbonインスタンス（１日から末日）の日付を比較
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

        // publicフォルダ内のテンプレートxlsxファイルをスプレッドシートで読込
        $spreadsheet = IOFactory::load(public_path() . '/excel/template.xlsx');
        // 選択シートにアクセスを開始
        $sheet = $spreadsheet->getActiveSheet();
        // テンプレートのセルに値を挿入
        $sheet->setCellValue('A1', date('Y年n月', strtotime($year_month)));
        $sheet->setCellValue('A3', $user->getName());
        $sheet->setCellValue('J3', '未来のかたち　' . $user->school->getName());
        for ($i = 0; $i < count($exceltables); $i++) {
            $celno = 7 + $i;
            $sheet->setCellValue('A' . $celno, $exceltables[$i]->getDay()->day . '日');
            $sheet->setCellValue('B' . $celno, $exceltables[$i]->getDay()->isoFormat('ddd'));
            // 変数に無名関数を代入
            $funstr = function ($i) use ($exceltables) {
                $string = '';
                if ($exceltables[$i]->getService() === false && $exceltables[$i]->getDay()->dayOfWeek !== 0) {
                    $string = '欠';
                    return $string;
                }
                return $string;
            };
            $sheet->setCellValue('C' . $celno, $funstr($i));
            $sheet->setCellValue('D' . $celno, $exceltables[$i]->getStart());
            $sheet->setCellValue('E' . $celno, $exceltables[$i]->getEnd());
            $sheet->setCellValue('G' . $celno, $exceltables[$i]->getFood_fg());
            $sheet->setCellValue('H' . $celno, $exceltables[$i]->getOutside_fg());
            $sheet->setCellValue('I' . $celno, $exceltables[$i]->getMedical_fg());
            $sheet->setCellValue('J' . $celno, $exceltables[$i]->getNote());
        }
        // 一時ファイルを作成するパスを選択
        Shared\File::setUseUploadTempDirectory(public_path());
        $writer = new Xlsx($spreadsheet);
        $writer->save(public_path() . '/excel/temporary/output.xlsx');
        // ダウンロードを促すレスポンスを返す
        return response()->download(
            // 対象のファイルパスを指定
            public_path() . '/excel/temporary/output.xlsx',
            // ファイル名を変更
            $year_month . '_' . $user->id . '_' . $user->getNameFull() . '.xlsx',
            // Httpヘッダーに配列を追加
            ['content-type' => 'application/vnd.ms-excel',]
        )
            // ダウンロード操作後にファイルを削除する
            ->deleteFileAfterSend(true);
    }


    // 利用者の実務記録表を所属校、年月で絞ってExcelで一括出力
    public function bulkExport(Request $request)
    {
        $year_month = $request->date;
        $school_id = $request->school_id;
        $users = User::schoolIdEqual($school_id)->get();

        foreach ($users as $user) {
            $records = Performance::where('user_id', $user->id)
                ->whereYear('insert_date', date('Y', strtotime($year_month)))
                ->whereMonth('insert_date', date('n', strtotime($year_month)))
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

            // publicフォルダ内のテンプレートxlsxファイルをスプレッドシートで読込
            $spreadsheet = IOFactory::load(public_path() . '/excel/template.xlsx');
            // 選択シートにアクセスを開始
            $sheet = $spreadsheet->getActiveSheet();

            // テンプレートのセルに値を挿入
            $sheet->setCellValue('A1', date('Y年n月', strtotime($year_month)));
            $sheet->setCellValue('A3', $user->getName());
            $sheet->setCellValue('J3', '未来のかたち　' . $user->school->getName());
            for ($i = 0; $i < count($exceltables); $i++) {
                $celno = 7 + $i;
                $sheet->setCellValue('A' . $celno, $exceltables[$i]->getDay()->day . '日');

                $funstr = function ($i) use ($exceltables) {
                    $string = '';
                    if ($exceltables[$i]->getService() === false && $exceltables[$i]->getDay()->dayOfWeek !== 0) {
                        $string = '欠';
                        return $string;
                    }
                    return $string;
                };

                $sheet->setCellValue('B' . $celno, $exceltables[$i]->getDay()->isoFormat('ddd'));
                $sheet->setCellValue('C' . $celno, $funstr($i));
                $sheet->setCellValue('D' . $celno, $exceltables[$i]->getStart());
                $sheet->setCellValue('E' . $celno, $exceltables[$i]->getEnd());
                $sheet->setCellValue('G' . $celno, $exceltables[$i]->getFood_fg());
                $sheet->setCellValue('H' . $celno, $exceltables[$i]->getOutside_fg());
                $sheet->setCellValue('I' . $celno, $exceltables[$i]->getMedical_fg());
                $sheet->setCellValue('J' . $celno, $exceltables[$i]->getNote());
            }

            Shared\File::setUseUploadTempDirectory(public_path());
            $writer = new Xlsx($spreadsheet);
            $writer->save(public_path() . '/excel/temporary/' . $year_month . '_' . $user->id . '_' . $user->getNameFull() . '.xlsx');
        }
        // 指定フォルダのファイルパスを連想配列で取得
        $files = glob(public_path() . '/excel/temporary/*');
        // ファイルパスで指定したファイルをzipで保存
        Madzipper::make(public_path() . '/excel/export/output.zip')->add($files)->close();
        // 指定フォルダ内のファイルを一括削除
        File::cleanDirectory(public_path() . '/excel/temporary');
        // ダウンロードを促すレスポンスを返す
        return response()->download(
            // 対象のファイルパスを指定
            public_path() . '/excel/export/output.zip',
            // ファイル名を変更
            $year_month . '_' . $user->school->getName() . '.zip',
            // Httpヘッダーに配列を追加
            ['content-type' => 'application/zip',]
        )
            // ダウンロード操作後にファイルを削除する
            ->deleteFileAfterSend(true);
    }
}
