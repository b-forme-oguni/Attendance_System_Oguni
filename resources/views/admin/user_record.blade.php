@extends('layouts.common_base')
@section('title','管理者メニュー')


@section('header')
<div class="d-flex justify-content-between mx-4">
    <div class="d-flex justify-content-left">

        {{ csrf_field() }}
        <select id="school_sel" class="form-control" name="select" onChange="location.href=value;">
            <option value="/user/0">全ての利用者</option>
            @foreach ($schools as $school)
            <option value="/user/{{ $school->id }}">

                {{ $school->getlName() }}</option>
            @endforeach

        </select>
        <script>
            document.getElementById('school_sel').options[

                '{{ $school_id }}'].selected = true;

        </script>
    </div>
    <div class="d-flex flex-row justify-content-left">

        {{ csrf_field() }}
        <a href="user_del" value="" class="button square_min">削除した利用者</a>
        <a href="user_reg" value="" class="button square_min">新規利用者登録</a>
    </div>
</div>
@endsection

@section('content')
@if (isset($users))
<table class="usertb my-5 mx-auto">
    <thead>
        <tr>
            <th>ID</th>
            <th>氏名</th>
            <th>カナ名</th>
            <th>所属</th>
            <th>登録日時</th>
            <th>更新日時</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        {{-- <tr onclick="location.href={{ $user->id }};"> --}}
        <tr onclick="location.href='/user_edit?id={{ $user->id }}';">
            <td>

                {{ $user->id }}</td>
            <td>

                {{ $user->getName() }}
            </td>
            <td>

                {{ $user->getNameKana() }}
            </td>
            <td>

                {{ $user->school->school_name }}
            </td>
            <td>

                {{ $user->created_at }}</td>
            <td>

                {{ $user->updated_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $users->links() }}
@endif
@endsection

@section('footer')
<div class="container">
    <div class="col-md-auto row justify-content-left">
        {{-- 変数の内容を表示
        <pre>
        {{ var_export($users, true)  }}</pre> --}}
    </div>
</div>
@endsection
