@extends('layouts.common_base')
@section('title','実績記録の変更')


@section('content')
<div class="container mt-4">
    <h2 class="text-center">@yield('title')</h2>

    <div class="row justify-content-center">
        <div class="col-md-8 my-4">
            <form action="" method="POST">

                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $record->id }}">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right">
                        日　付</label>
                    <div class="col-md-8">
                        <input type="date" name="insert_date" class="form-control" value="{{ $record->insert_date }}">
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

                        {{ Form::select('user_id', $userslist, $record->user_id, ['class' => 'form-control']) }}
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
                        開始時間</label>
                    <div class="col-md-8">
                        {{ Form::select('start', $timetable, $record->start, ['class' => 'form-control']) }}
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
                        @if (!is_null($record->end))

                        {{ Form::select('end', $timetable, $record->end, ['class' => 'form-control']) }}
                        @else
                        <label class="form-control">

                            終了打刻がまだ入力されていません！</label>
                        @endif
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right">
                        食事提供加算フラグ</label>
                    <div class="col-md-8">
                        <input name="food_fg" type="hidden" value="0" />
                        <input name="food_fg" type="checkbox" value="1" {{ $food_fg ? 'checked' : '' }} />

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right">
                        施設外支援フラグ</label>
                    <div class="col-md-8">
                        <input name="outside_fg" type="hidden" value="0" />
                        <input name="outside_fg" type="checkbox" value="1" {{ $outside_fg ? 'checked' : '' }} />

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right">
                        医療連携体制加算フラグ</label>
                    <div class="col-md-8">
                        <input name="medical_fg" type="hidden" value="0" />
                        <input name="medical_fg" type="checkbox" value="1" {{ $medical_fg ? 'checked' : '' }} />

                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right">
                        備　考</label>
                    <div class="col-md-8">

                        {{ Form::select('note_id', $noteslist, $record->note_id, ['class' => 'form-control']) }}
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-2">
                        <button type="submit" formaction="edit" class="button square_min">
                            実務記録を変更
                        </button>
                        <a href="{{ session('return_url') }}" class="button square_min">戻　る</a>
                        <button type="submit" formaction="delete" class="button square_min">
                            実務記録を削除</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
