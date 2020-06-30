@extends('layouts.common_base')
@section('title','出欠管理システム')

@section('header_admin_menu')
<li>
    <a class="button square_min" href="/menu">

        管理者メニュー</a>
</li>
@endsection

@section('content')
<div class="row justify-content-center py-4">
    <div class="col-md-8">
        <h2 class="text-center">打刻開始する学校を選択</h2>
        <div class="p-4">
            @foreach ($schools as $school)
            <a class="button square" href="stamp/{{ $school->id }}?index=all">

                {{ $school->getName() }}</a>

            @endforeach
        </div>
    </div>
</div>
@endsection
