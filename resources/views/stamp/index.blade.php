@extends('layouts.common_base')
@section('title','出欠管理システム')

@section('header_menu_main')
<h1><a href="{{ url('/') }}">

        出欠管理システム
    </a></h1>
@endsection

@section('header_menu_sub')
<ul class="record_menu d-flex list-unstyled">
    <li>
        <a class="button square_min" href="/menu">

            管理者メニュー</a>
    </li>
</ul>
@endsection

@section('content')
<div class="row justify-content-center py-4">
    <div class="col-md-8">
        <h2 class="text-center">打刻開始する校を選択</h2>
        <div class="p-4">
            @foreach ($schools as $school)
            <a class="button square" href="stamp/{{ $school->id }}?index=all">

                {{ $school->getName() }}</a>

            @endforeach
        </div>
    </div>
</div>
@endsection
