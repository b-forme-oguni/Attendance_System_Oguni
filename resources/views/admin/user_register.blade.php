@extends('layouts.common_base')
@section('title','新規利用者登録')


@section('header')
<div class="container mt-4">
    <div class="row justify-content-center">
    </div>
</div>
@endsection

@section('content')
<div class="container mt-4">
    <div class="">
        <h2 class="text-center">@yield('title')</h2>
        <div class="col-md-8">
            <form action="/user_reg" method="POST">

                {{ csrf_field() }}
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">
                        氏　名</label>

                    <div class="col-md-4 row">
                        <input type="text" name="last_name" placeholder="姓">
                    </div>
                    <div class="col-md-4 row">
                        <input type="text" name="first_name" placeholder="名">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">
                        カナ名</label>

                    <div class="col-md-4 row">
                        <input type="text" name="last_name_kana" placeholder="セイ">
                    </div>
                    <div class="col-md-4 row">
                        <input type="text" name="first_name_kana" placeholder="メイ">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">
                        所　属</label>

                    <div class="col-md-4 row">
                        <select class="form-control" name="school_id">
                            @foreach ($schools as $school)
                            <option value="{{ $school->id }}">

                                {{ $school->getlName() }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="button square_min">
                            登　録
                        </button>
                        <a href="user/0" class="button square_min">戻　る</a>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
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
