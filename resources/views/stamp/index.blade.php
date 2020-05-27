@extends('layouts.common_base')
@section('title','出欠管理システム')


@section('header')
<div class="container mt-4">
    <div class="row justify-content-center">
        <h2 class="text-center">@yield('title')</h2>
    </div>
</div>
@endsection

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @foreach ($schools as $school)
            <a class="button square" href="stamp/{{ $school->id }}?index=all">

                {{ $school->getlName() }}</a>

            @endforeach
        </div>
    </div>
</div>
@endsection

@section('footer')
<div class="container">
    <div class="col-md-auto row justify-content-left">

            <a class="button square_min" href="admin">管理者メニュー</a>
    </div>
</div>
@endsection
