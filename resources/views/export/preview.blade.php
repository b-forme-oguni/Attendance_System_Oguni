@extends('layouts.common_base')
@section('title','Excel出力プレビュー')

@section('header_record_school')
<form action="preview" method="GET" class="d-flex">
    <dl class="d-flex align-items-center">
        <dt>
            所属：</dt>
        <dd>

            {{ Form::select('school_id', $schoolselect, $school_id, ['placeholder' => '選択してください','class' => 'form-control', 'onChange' => 'submit(this.form)']) }}
        </dd>
    </dl>
    <dl class="d-flex align-items-center">
        <dt>
            利用者：</dt>
        <dd>

            {{ Form::select('user_id', $userslist, $user_id,['placeholder' => '選択してください','class' => 'form-control', 'onChange' => 'submit(this.form)']) }}
        </dd>
    </dl>
    <dl class="d-flex align-items-center">
        <dt>
            年月：</dt>
        <dd>
            <input type="month" name="year_month" value={{ $year_month }} class="form-control" onChange='submit(this.form)'>
        </dd>
    </dl>
</form>
@endsection

@section('header_admin_menu')
@if (isset($user))

<li>
    <a class="button square_min" href="/preview/export?id={{ $user->id }}&date={{ $year_month }}">

        Excel出力</a>
</li>
@endif

<li>
    <a class="button square_min" href="/menu">

        管理者メニュー</a>
</li>
@endsection

@section('content')
<div class="my-4 col-md-12">

    @if (isset($user))

    @include('export.export')
    @endif
</div>
@endsection
