@extends('layouts.common_base')
@section('title','管理者メニュー')

@section('header_record_school')
<dl class="d-flex align-items-center">
    <dt>
        所属：</dt>
    <dd>
        <form action="user" method="GET">

            {{ Form::select('school_id', $schoolselect, $school_id, ['class' => 'form-control', 'onChange' => 'submit(this.form)']) }}
        </form>
    </dd>
</dl>
<ul class="record_menu d-flex list-unstyled">
    <li><a href="/delete" value="" class="button square_min">削除した利用者</a></li>
    <li><a href="/user_reg" value="" class="button square_min">新規利用者登録</a></li>
</ul>
@endsection

@section('header_record_menu')

@endsection

@section('header_admin_menu')
<li>
    <a class="button square_min" href="/admin">

        管理者メニュー</a>
</li>
@endsection

@section('content')
<div class="my-5 col-md-12">
    @if (isset($users))
    <table class="usertb">
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
            <tr class="edit_sel" onclick="location.href='/user_edit?id={{ $user->id }}';">
                <td>

                    {{ $user->id }}</td>
                <td>

                    {{ $user->getName() }}
                </td>
                <td>

                    {{ $user->getNameKana() }}
                </td>
                <td>

                    {{ $user->school->getName() }}
                </td>
                <td>

                    {{ $user->created_at }}</td>
                <td>

                    {{ $user->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3">

        {{ $users->appends(['school_id' => $school_id])->links() }}
    </div>
</div>
@endif
@endsection
