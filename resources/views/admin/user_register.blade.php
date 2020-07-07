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
                    <input type="text" name="last_name" placeholder="姓" class="form-control" value="{{old('last_name')}}">
                    @if($errors->has('last_name'))

                    <span class="error_msg" role="alert">
                        <strong>

                            {{ $errors->first('last_name') }} </strong>
                    </span>
                    @endif
                </div>
                <div class="col-md-5">
                    <input type="text" name="first_name" placeholder="名" class="form-control" value="{{old('first_name')}}">
                    @if($errors->has('first_name'))

                    <span class="error_msg" role="alert">
                        <strong>

                            {{ $errors->first('first_name') }} </strong>
                    </span>
                    @endif
                </div>

            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label text-md-right">
                    カナ名</label>
                <div class="col-md-5">
                    <input type="text" name="last_name_kana" placeholder="セイ" class="form-control" value="{{old('last_name_kana')}}">
                    @if($errors->has('last_name_kana'))

                    <span class="error_msg" role="alert">
                        <strong>

                            {{ $errors->first('last_name_kana') }} </strong>
                    </span>
                    @endif
                </div>
                <div class="col-md-5">
                    <input type="text" name="first_name_kana" placeholder="メイ" class="form-control" value="{{old('first_name_kana')}}">
                    @if($errors->has('first_name_kana'))

                    <span class="error_msg" role="alert">
                        <strong>

                            {{ $errors->first('first_name_kana') }} </strong>
                    </span>
                    @endif
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
