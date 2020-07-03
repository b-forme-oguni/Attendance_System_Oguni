@extends('layouts.common_base')
@section('title','管理者メニュー')

@section('header_menu_main')
<h1><a href="{{ url('/') }}">

        出欠管理システム
    </a></h1>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/">Top</a></li>
<li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
@endsection

@section('content')
<div class="container">
    <div class="d-flex justify-content-center">
        <div class="col-md-8 my-4">
            <a class="button square" href="user">利用者管理</a>
            <a class="button square" href="performance">実績記録管理</a>
        </div>
    </div>
</div>
@endsection
