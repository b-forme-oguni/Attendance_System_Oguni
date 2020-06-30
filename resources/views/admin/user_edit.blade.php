@extends('layouts.common_base')
@section('title','利用者情報の変更')

@section('content')
<div class="container mt-4">
    <h2 class="text-center">@yield('title')</h2>
    <div class="row justify-content-center">
        <div class="col-md-8 my-4">
            <form action="edit" method="POST">

                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $user->id }}">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right">
                        氏　名</label>

                    <div class="col-md-4">
                        <input type="text" name="last_name" value="{{ $user->last_name }}" placeholder="姓" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="first_name" value="{{ $user->first_name }}" placeholder="名" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right">
                        カナ名</label>

                    <div class="col-md-4">
                        <input type="text" name="last_name_kana" value="{{ $user->last_name_kana }}" placeholder="セイ" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="first_name_kana" value="{{ $user->first_name_kana }}" placeholder="メイ" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right">
                        所　属</label>

                    <div class="col-md-4">

                        {{ Form::select('school_id', $schoolslist, $user->school_id, ['class' => 'form-control']) }}

                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-2">
                        <button type="submit" class="button square_min">
                            変　更
                        </button>
                        <a href="/user" class="button square_min">戻　る</a>
                        <a href="delete?id={{ $user->id }}" class="button square_min">削　除</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
