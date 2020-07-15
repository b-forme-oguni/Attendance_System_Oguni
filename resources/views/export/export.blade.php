<table class="caption">
    <tbody>
        <tr>
            <td>

                {{ date('Y年', strtotime($year_month)) }}
            </td>
        </tr>
        <tr>
            <td>

                {{ date('n月', strtotime($year_month)) }}
            </td>
        </tr>
    </tbody>
</table>
<table class="recordtb">
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
            <th rowspan="2">サービス提供<br>の状況</th>
            <th rowspan="2">開始時間</th>
            <th rowspan="2">終了時間</th>
            <th>訪問支援特別加算</th>
            <th rowspan="2">食事提供<br>加算</th>
            <th rowspan="2">施設外<br>支援</th>
            <th rowspan="2">医療連携<br>体制加算</th>
        </tr>
        <tr>
            <th>時間数</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($exceltables as $exceltable)
        <tr>
            <td>
                {{-- 日付 --}}

                {{ $exceltable->getDay()->day }}日</td>
            <td>
                {{-- 曜日 --}}

                {{ $exceltable->getDay()->isoFormat('ddd') }}
            </td>
            <td>{{-- サービス提供の状況 --}}
                @if ( $exceltable->getService() === false && $exceltable->getDay()->dayOfWeek !== 0)
                欠
                @endif
            </td>
            <td>
                {{-- 開始時間 --}}

                {{ $exceltable->getStart() }}
            </td>
            <td>
                {{-- 終了時間 --}}

                {{ $exceltable->getEnd() }}
            </td>
            <td>
                {{-- 訪問支援特別加算 --}}
            </td>
            <td>
                {{-- 食事提供加算 --}}

                {{ $exceltable->getFood_fg() }}
            </td>
            <td>
                {{-- 施設外支援加算 --}}

                {{ $exceltable->getOutside_fg() }}
            </td>
            <td>
                {{-- 医療連携加算 --}}

                {{ $exceltable->getMedical_fg() }}
            </td>
            <td>
                {{-- 備考 --}}

                {{ $exceltable->getNote() }}
            </td>
            <td>
                {{-- 利用者確認印 --}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
