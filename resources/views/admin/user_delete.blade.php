@extends('layouts.common_base')
@section('title','削除した利用者')

@section('header_menu_main')
<form action="deleteindex" method="GET">
    <dl class="d-flex align-items-center">
        <dt>
            所属：</dt>
        <dd>

            {{ Form::select('school_id', $schoolselect->prepend('全ての利用者', '0'), $school_id, ['class' => 'form-control', 'onChange' => 'submit(this.form)']) }}
        </dd>
    </dl>
</form>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/">Top</a></li>
<li class="breadcrumb-item"><a href="menu">管理者メニュー</a></li>
<li class="breadcrumb-item"><a href="/user">利用者管理</a></li>
<li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
@endsection

@section('content')
@if (isset($users))
<form method="post" action="">
    @csrf
    <table class="usertb mb-2">
        <thead>
            <tr>
                <th>選択</th>
                <th>ID</th>
                <th>氏名</th>
                <th>カナ名</th>
                <th>所属</th>
                <th>登録日時</th>
                <th>削除日時</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>
                    <input type="checkbox" name="id[]" value="{{ $user->id }}">
                </td>
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

                    {{ $user->deleted_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-2">
        <button type="submit" formaction="revival" class="button square_min">再登録</button>
        <button type="submit" formaction="truedelete" class="button square_min">完全に削除</button>
    </div>
</form>
<div class="mt-3">

    {{ $users->appends(['school_id' => $school_id])->links() }}
</div>
@endif
@endsection
