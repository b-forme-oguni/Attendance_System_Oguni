@extends('layouts.common_base')
@section('title','管理者メニュー')

@section('header_record_school')
<dl class="d-flex align-items-center">
    <dt>
        所属：</dt>
    <dd>
        <select id="school_sel" class="form-control" name="select" onChange="location.href=value;">
            <option value="/performance/0">全ての利用者</option>
            @foreach ($schools as $school)
            <option value="/performance/{{ $school->id }}">

                {{ $school->getName() }}</option>
            @endforeach
        </select>
    </dd>
</dl>

@endsection

@section('header_record_menu')
<ul class="record_menu d-flex list-unstyled">
    <li><a href="/delete/0" value="" class="button square_min">削除した利用者</a></li>
    <li><a href="/user_reg" value="" class="button square_min">新規利用者登録</a></li>
</ul>
@endsection

@section('content')
@if (isset($records))
<table class="usertb my-5 mx-auto">
    <thead>
        <tr>
            <th>日付</th>
            <th>利用者ID</th>
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

                {{ $record->user_id}}
            </td>
            <td>

                {{ $record->user->getName() }}
            </td>
            <td>

                {{ $record->user->school->getName() }}
            </td>
            <td>

                {{ $record->start }}
            </td>
            <td>

                {{ $record->end }}
            </td>
            <td>

                {{ $record->getFlag($record->food_fg) }}</td>
            <td>

                {{ $record->getFlag($record->outside_fg) }}</td>
            <td>

                {{ $record->getFlag($record->medical_fg) }}</td>
            <td>

                {{ $record->getNote() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $records->links() }}
@endif
@endsection
