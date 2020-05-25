@extends('layouts.common_base')
@section('title','管理者メニュー')


@section('header')
<div class="container mt-5">
    <div class="row justify-content-center">
        <h2 class="text-center">@yield('title')</h2>
    </div>
</div>
@endsection

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <a class="button square" href="user/0">利用者管理</a>
            <a class="button square" href="performance">実績記録管理</a>
        </div>
    </div>
</div>
@endsection

@section('footer')
<div class="container">
    <div class="col-md-auto row justify-content-left">

    </div>
</div>
@endsection
