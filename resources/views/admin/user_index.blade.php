@extends('layouts.common_base')
@section('title','利用者管理')

@section('header_menu_main')
<dl class="d-flex align-items-center">
    <dt>
        所属：</dt>
    <dd>
        <form action="user" method="GET">

            {{ Form::select('school_id', $schoolselect->prepend('全ての利用者', '0'), $school_id, ['class' => 'form-control', 'onChange' => 'submit(this.form)']) }}
        </form>
    </dd>
</dl>
@endsection

@section('header_menu_sub')
<ul class="menu_sub d-flex list-unstyled">
    <li><a href="user/store" class="button square_min">新規利用者登録</a></li>
    <li><a href="user/deleteindex" class="button square_min">削除した利用者</a></li>
</ul>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/">Top</a></li>
<li class="breadcrumb-item"><a href="menu">管理者メニュー</a></li>
<li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
@endsection

@section('content')
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
            <tr class="edit_sel" onclick="location.href='user/edit?id={{ $user->id }}';">
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
@endif
@endsection
