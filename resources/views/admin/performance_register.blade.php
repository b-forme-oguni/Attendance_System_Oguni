@extends('layouts.common_base')
@section('title','実績記録作成')

@section('header_menu_main')
<form action="store" method="GET" class="d-flex">
    <input type="hidden" name="date" value="{{ $date }}">
    <dl class="d-flex align-items-center mr-2">
        <dt>
            所属：</dt>
        <dd>

            {{ Form::select('school_id', $schoolselect, $school_id, ['placeholder' => '選択してください','class' => 'form-control', 'onChange' => 'submit(this.form)']) }}
        </dd>
    </dl>
</form>
@endsection

@section('content')
<div class="container mt-4">
    <h2 class="text-center">@yield('title')</h2>
    <div class="row justify-content-center">
        <div class="col-md-8 my-4">

            <form action="store" method="POST">

                {{ csrf_field() }}
                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right">
                        日　付</label>
                    <div class="col-md-8">

                        {{ Form::date('insert_date', $date,['class' => 'form-control']) }}

                        @error('insert_date')
                        <span class="error_msg" role="alert">
                            <strong>

                                {{ $message }} </strong>
                        </span>
                        @enderror
                    </div>

                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right">
                        利用者</label>
                    <div class="col-md-8">

                        {{ Form::select('user_id', $userslist, $user_id,['placeholder' => '選択してください','class' => 'form-control']) }}
                        @error('user_id')
                        <span class="error_msg" role="alert">
                            <strong>

                                {{ $message }} </strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right">
                        開始時間</label>
                    <div class="col-md-8">
                        {{ Form::select('start', $timetable, '09:30',['class' => 'form-control']) }}
                        @error('start')
                        <span class="error_msg" role="alert">
                            <strong>

                                {{ $message }} </strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right">
                        終了時間</label>
                    <div class="col-md-8">

                        {{ Form::select('end', $timetable,'16:00',['class' => 'form-control']) }}

                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right">
                        食事提供加算フラグ</label>
                    <div class="col-md-8">
                        <input name="food_fg" type="hidden" value="0" />
                        <input name="food_fg" type="checkbox" value="1" />

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right">
                        施設外支援フラグ</label>
                    <div class="col-md-8">
                        <input name="outside_fg" type="hidden" value="0" />
                        <input name="outside_fg" type="checkbox" value="1" />

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right">
                        医療連携体制加算フラグ</label>
                    <div class="col-md-8">
                        <input name="medical_fg" type="hidden" value="0" />
                        <input name="medical_fg" type="checkbox" value="1" />

                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right">
                        備　考</label>
                    <div class="col-md-8">

                        {{ Form::select('note_id', $noteslist, 0,['class' => 'form-control']) }}
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-2">
                        <button type="submit" class="button square_min">
                            作　成
                        </button>
                        <a href="{{ session('return_url') }}" class="button square_min">戻　る</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
