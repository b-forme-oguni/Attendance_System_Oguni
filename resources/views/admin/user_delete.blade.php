@extends('layouts.common_base')
@section('title','管理者メニュー')

@section('header_record_school')
<dl class="d-flex align-items-center">
    <dt>
        所属：</dt>
    <dd>
        <select id="school_sel" class="form-control" name="select" onChange="location.href=value;">
            <option value="/delete/0">全ての利用者</option>
            @foreach ($schools as $school)
            <option value="/delete/{{ $school->id }}">

                {{ $school->getName() }}</option>
            @endforeach
        </select>
    </dd>
</dl>

@endsection

@section('header_record_menu')
<ul class="record_menu d-flex list-unstyled">
    <li><a href="/user/0" value="" class="button square_min">利用者一覧に戻る</a></li>
</ul>
@endsection

@section('content')
@if (isset($users))
<div class="my-5 mx-auto">
    <form method="post" action="">
        @csrf
        <button type="submit" formaction="/revival/{{ $school_id }}" class="button square_min">再登録</button>
        <button type="submit" formaction="/truedelete/{{ $school_id }}" class="button square_min">完全に削除</button>
        <table class="usertb mb-2">
            <thead>
                <tr>
                    <th>削除</th>
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

                        {{ $user->updated_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>

    {{ $users->links() }}
</div>
@endif
@endsection
