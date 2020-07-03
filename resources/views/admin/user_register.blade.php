@extends('layouts.common_base')
@section('title','新規利用者登録')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/">Top</a></li>
<li class="breadcrumb-item"><a href="/menu">管理者メニュー</a></li>
<li class="breadcrumb-item"><a href="/user">利用者管理</a></li>
<li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
@endsection

@section('content')
<h2 class="text-center">@yield('title')</h2>
<div class="row justify-content-center">
    <div class="col-md-8 my-4">
        <form action="store" method="POST">

            {{ csrf_field() }}
            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">
                    氏　名</label>
                <div class="col-md-5">
                    <input type="text" name="last_name" placeholder="姓" class="form-control">
                </div>
                <div class="col-md-5">
                    <input type="text" name="first_name" placeholder="名" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">
                    カナ名</label>
                <div class="col-md-5">
                    <input type="text" name="last_name_kana" placeholder="セイ" class="form-control">
                </div>
                <div class="col-md-5">
                    <input type="text" name="first_name_kana" placeholder="メイ" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">
                    所　属</label>

                <div class="col-md-5">

                    {{ Form::select('school_id', $schoolselect, 1, ['class' => 'form-control']) }}
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-2">
                    <button type="submit" class="button square_min">
                        登　録
                    </button>
                    <a href="/user" class="button square_min">戻　る</a>

                </div>
            </div>
        </form>
    </div>
</div>
@endsection
