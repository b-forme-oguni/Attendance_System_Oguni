@extends('layouts.common_base')
@section('title','管理者メニュー')

@section('header_record_school')

<form action="deleteindex" method="GET">
    <dl class="d-flex align-items-center">
        <dt>
            所属：</dt>
        <dd>

            {{ Form::select('school_id', $schoolselect, $school_id, ['class' => 'form-control', 'onChange' => 'submit(this.form)']) }}
        </dd>
    </dl>
</form>
@endsection

@section('header_record_menu')
<ul class="record_menu d-flex list-unstyled">
    <li><a href="/user" value="" class="button square_min">利用者一覧に戻る</a></li>
</ul>
@endsection

@section('content')
@if (isset($users))
<div class="my-5 col-md-12">
    <form method="post" action="">
        @csrf
        <div class="mb-3">
            <button type="submit" formaction="revival" class="button square_min">再登録</button>
            <button type="submit" formaction="truedelete" class="button square_min">完全に削除</button>
        </div>
        <table class="usertb mb-2">
            <thead>
                <tr>
                    <th>削除</th>
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


    </form>
    <div class="mt-3">

        {{ $users->appends(['school_id' => $school_id])->links() }}
    </div>

</div>
@endif
@endsection
