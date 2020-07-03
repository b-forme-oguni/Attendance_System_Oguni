@extends('layouts.common_base')
@section('title','Excel出力プレビュー')

@section('header_menu_main')
<form action="preview" method="GET" class="d-flex">
    <dl class="d-flex align-items-center">
        <dt>
            所属：</dt>
        <dd>

            {{ Form::select('school_id', $schoolselect, $school_id, ['placeholder' => '選択してください','class' => 'form-control', 'onChange' => 'submit(this.form)']) }}
        </dd>
    </dl>
    <dl class="d-flex align-items-center">
        <dt>
            利用者：</dt>
        <dd>

            {{ Form::select('user_id', $userslist, $user_id,['placeholder' => '選択してください','class' => 'form-control', 'onChange' => 'submit(this.form)']) }}
        </dd>
    </dl>
    <dl class="d-flex align-items-center">
        <dt>
            年月：</dt>
        <dd>
            <input type="month" name="year_month" value={{ $year_month }} class="form-control" onChange='submit(this.form)'>
        </dd>
    </dl>
</form>
@endsection

@section('header_menu_sub')
@if (isset($user))
<ul class="menu_sub d-flex list-unstyled">
    <li>
        <a class="button square_min" href="/preview/export?id={{ $user->id }}&date={{ $year_month }}">

            Excel出力</a>
    </li>
</ul>
@endif
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/">Top</a></li>
<li class="breadcrumb-item"><a href="/menu">管理者メニュー</a></li>
<li class="breadcrumb-item"><a href="/performance">実績記録管理</a></li>
<li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
@endsection


@section('content')
@if (isset($user))
<table class="caption">
    <tbody>
        <tr>
            <td>

                {{ date('Y年n月', strtotime($year_month)) }}
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

        @if ($exceltable->getService() === false)
        <tr class="edit_sel" onclick="location.href='/performance/store?id={{ $user->id }}&date={{ $exceltable->getDay()->toDateString() }}'">
            @else
        <tr class="edit_sel" onclick="location.href='/performance/edit?id={{ $exceltable->getId() }}'">
            @endif

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

                {{ $exceltable->getend() }}
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
@endif
@endsection
