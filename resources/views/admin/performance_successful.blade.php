@extends('layouts.common_base')
@section('title', $title)

@section('content')
<div class="container mt-4">
    <h2 class="text-center">@yield('title')</h2>

    <div class="row justify-content-center">

        <div class="col-md-8 my-4">

                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right">
                        日　付</label>
                    <div class="col-md-8">
                        {{ $record->insert_date }} </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right">
                        利用者</label>
                    <div class="col-md-8">
                        {{ $record->user->getName() }}
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right">
                        開始時間</label>
                    <div class="col-md-8">
                        {{ $record->start }}
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right">
                        終了時間</label>
                    <div class="col-md-8">
                        {{ $record->end }}
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right">
                        食事提供加算フラグ</label>
                    <div class="col-md-8">
                        {{ $record->food_fg }}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right">
                        施設外支援フラグ</label>
                    <div class="col-md-8">
                        {{ $record->outside_fg }}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right">
                        医療連携体制加算フラグ</label>
                    <div class="col-md-8">
                        {{ $record->medical_fg }}
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label text-md-right">
                        備　考</label>
                    <div class="col-md-8">
                        {{ $record->note->note }}
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-2">
                        <a href="performance/0" class="button square_min">戻　る</a>
                    </div>
                </div>

        </div>
    </div>
</div>
@endsection
