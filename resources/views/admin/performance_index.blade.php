@extends('layouts.common_base')
@section('title','実績記録管理')

@section('header_menu_main')
<form action="performance" method="GET" class="d-flex">
    <dl class="d-flex align-items-center mr-2">
        <dt>
            所属：</dt>
        <dd>

            {{ Form::select('school_id', $schoolselect, $school_id, ['class' => 'form-control', 'onChange' => 'submit(this.form)']) }}
        </dd>
    </dl>
    <dl class="d-flex align-items-center mr-2">
        <dt>
            日付：</dt>
        <dd>

            {{ Form::date('date', $date, ['class' => 'form-control', 'onChange' => 'submit(this.form)']) }}
        </dd>
    </dl>
</form>
@endsection

@section('header_menu_sub')
<ul class="menu_sub d-flex list-unstyled">
    <li>
        <a class="button square_min" href="/performance/store">

            実績記録作成</a>
    </li>
    <li>
        <a class="button square_min" href="/preview">

            Excel出力プレビュー</a>
    </li>
</ul>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/">Top</a></li>
<li class="breadcrumb-item"><a href="/menu">管理者メニュー</a></li>
<li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
@endsection

@section('content')
@if (isset($records))
<table class="usertb">
    <thead>
        <tr>
            <th>日付</th>
            <th>利用者名</th>
            <th>所属</th>
            <th>開始時間</th>
            <th>終了時間</th>
            <th>食事提供加算</th>
            <th>施設外支援</th>
            <th>医療連携体制加算</th>
            <th>備考</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($records as $record)
        <tr class="edit_sel" onclick="location.href='/performance/edit?id={{ $record->id }}';">
            <td>

                {{ $record->insert_date }}</td>
            <td>

                {{ $record->user_id}}：

                {{ $record->user->getName() }}
            </td>
            <td>

                {{ $record->user->school->getName() }}
            </td>
            <td>

                {{ $record->getStart() }}
            </td>
            <td>

                {{ $record->getEnd() }}
            </td>
            <td>

                {{ $record->getFlagsign($record->food_fg) }}</td>
            <td>

                {{ $record->getFlagsign($record->outside_fg) }}</td>
            <td>

                {{ $record->getFlagsign($record->medical_fg) }}</td>
            <td>

                {{ $record->getNote() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-3">

    {{ $records->appends(['school_id' => $school_id,'date' => $date])->links() }}
</div>
@endif
@endsection
