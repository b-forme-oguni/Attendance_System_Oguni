@extends('layouts.common_base')
@section('title','管理者メニュー')

@section('content')
<div class="container my-4">
    <h2 class="text-center">@yield('title')</h2>
    <div class="row justify-content-center">
        <div class="col-md-8 my-4">
            <a class="button square" href="user/0">利用者管理</a>
            <a class="button square" href="performance/0">実績記録管理</a>
        </div>
    </div>
</div>
@endsection
