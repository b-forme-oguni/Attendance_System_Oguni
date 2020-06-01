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
@if (isset($performances))
<table class="usertb my-5 mx-auto">
    <thead>
        <tr>
            <th>日付</th>
            <th>氏名</th>
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
        @foreach ($performances as $performance)
        {{-- <tr onclick="location.href={{ $user->id }};"> --}}
        <tr class="edit_sel" onclick="location.href='/user_edit?id={{ $performance->id }}';">
            <td>

                {{ $performance->insert_date }}</td>
            <td>

                {{ $performance->user->getName() }}
            </td>
            <td>

                {{ $performance->user->school->getName() }}
            </td>
            <td>

                {{ $performance->start }}
            </td>
            <td>

                {{ $performance->end }}
            </td>
            <td>

                {{ $performance->getFlag($performance->food_fg) }}</td>
            <td>

                {{ $performance->getFlag($performance->outside_fg) }}</td>
            <td>

                {{ $performance->getFlag($performance->medical_fg) }}</td>
            <td>

                {{ $performance->getNote() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $performances->links() }}
@endif
@endsection
