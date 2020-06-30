@extends('layouts.common_base')
@section('title','管理者メニュー')

@section('header_record_school')

<form action="/performance" method="GET" class="d-flex">
    <dl class="d-flex align-items-center">
        <dt>
            所属：</dt>
        <dd>

            {{ Form::select('school_id', $schoolselect, $school_id, ['class' => 'form-control', 'onChange' => 'submit(this.form)']) }}
        </dd>
    </dl>
    <dl class="d-flex align-items-center">
        <dt>
            日付：</dt>
        <dd>

            {{ Form::date('day', $day, ['class' => 'form-control', 'onChange' => 'submit(this.form)']) }}
        </dd>
    </dl>
</form>

<ul class="record_menu d-flex list-unstyled">
    <li><a href="/performance_reg" value="" class="button square_min">新規実績記録登録</a></li>
</ul>
@endsection



@section('header_admin_menu')
<li>
    <a class="button square_min" href="/output/index">

        Excel出力一覧</a>
</li>
<li>
    <a class="button square_min" href="/menu">

        管理者メニュー</a>
</li>
@endsection

@section('content')
<div class="my-5 col-md-12">

@if (isset($records))
<table class="usertb my-5 mx-auto">
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
        {{-- <tr onclick="location.href={{ $user->id }};"> --}}
        <tr class="edit_sel" onclick="location.href='/performance_edit?id={{ $record->id }}';">
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

    {{ $records->appends(['school_id' => $school_id,'day' => $day])->links() }}
</div>
</div>
@endif
@endsection
