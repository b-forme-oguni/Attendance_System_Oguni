@extends('layouts.common_base')
@section('title','利用者情報の変更')

@section('content')
<div class="container mt-4">
    <h2 class="text-center">@yield('title')</h2>
    <div class="row justify-content-center">
        <div class="col-md-8 my-4">
            <form action="/performance_edit" method="POST">

                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $record->id }}">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right">
                        日　付</label>
                    <div class="col-md-8">
                        <input type="date" name="insert_date" class="form-control" value="{{ $record->insert_date }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right">
                        利用者</label>
                    <div class="col-md-8">
                        {{ Form::select('user_id', $userslist, $record->user_id, ['class' => 'form-control']) }}
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right">
                        開始時間</label>
                    <div class="col-md-8">
                        <input class="form-control" name="start" type="time" min="09:30" max="16:00" step="900" value="{{ date('H:i', strtotime($record->start) )}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right">
                        終了時間</label>
                    <div class="col-md-8">
                        <input class="form-control" name="end" type="time" min="09:30" max="16:00" step="900" value="{{ date('H:i', strtotime($record->end) )}}">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-2">
                        <button type="submit" class="button square_min">
                            変　更
                        </button>
                        <a href="performance/0" class="button square_min">戻　る</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
