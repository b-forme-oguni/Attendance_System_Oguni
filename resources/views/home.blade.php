@extends('layouts.app')

@section('header_admin_menu')
<li>
    <a class="button square_min" href="/admin">

        管理者メニュー</a>
</li>
@endsection

@section('content')
<div class="row justify-content-center py-4">
    <div class="col-md-8">
        @if (session('status'))
        <div class="alert alert-success" role="alert">

            {{ session('status') }}
        </div>
        @endif
        <h2 class="text-center">ログインしました</h2>
    </div>
</div>
@endsection
