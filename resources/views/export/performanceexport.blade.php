<table>
    <thead>
        <tr>
            <th colspan="3">支援決定障害者氏名</th>
            <th colspan="6" rowspan="2">実績記録表</th>
            <th colspan="2">事業者および事業所</th>
        </tr>
        <tr>
            <td colspan="3">

                {{ $user->getName() }}</td>
            <td colspan="2">未来のかたち　

                {{ $user->school->getName() }}</td>
        </tr>
        <tr>
            <th rowspan="3">日付</th>
            <th rowspan="3">曜日</th>
            <th colspan="7">サービス提供実績</th>
            <th rowspan="3">備考</th>
            <th rowspan="3">利用者確認印</th>

        </tr>
        <tr>
            <th rowspan="2">サービス提供の状況</th>
            <th rowspan="2">開始時間</th>
            <th rowspan="2">終了時間</th>
            <th>訪問支援特別加算</th>
            <th rowspan="2">食事提供加算</th>
            <th rowspan="2">施設外支援</th>
            <th rowspan="2">医療連携体制加算</th>
        </tr>
        <tr>
            <th>時間数</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($records as $record)
        <tr>
            <td>
                {{-- 日付 --}}

                {{ $record->insert_date }}</td>
            <td>
                {{-- 曜日 --}}

                {{ $record->insert_date }}
            </td>
            <td>
                {{-- 欠席の場合、欠を表示 --}}

                {{ $record->user->school->getName() }}
            </td>
            <td>
                {{-- 開始時間 --}}

                {{ $record->getStart() }}
            </td>
            <td>
                {{-- 終了時間 --}}

                {{ $record->getEnd() }}
            </td>
            <td>
                {{-- 訪問支援特別加算時間 --}}

            </td>
            <td>
                {{-- 食事提供加算 --}}
                {{ $record->getFlag($record->food_fg) }}</td>
            <td>
                {{-- 施設外支援加算 --}}
                {{ $record->getFlag($record->outside_fg) }}</td>
            <td>
                {{-- 医療連携加算 --}}
                {{ $record->getFlag($record->medical_fg) }}</td>
            <td>
                {{-- 備考 --}}
                {{ $record->getNote() }}</td>
            <td>
                {{-- 利用者確認印 --}}

            </tr>
        @endforeach
    </tbody>
</table>
