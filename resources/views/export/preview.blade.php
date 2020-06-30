@extends('layouts.common_base')

@section('header_admin_menu')
<li>
    <a class="button square_min" href="/output/export?id={{ $user->id }}&date={{ $year_month }}">

        Excel出力</a>
</li>
<li>
    <a class="button square_min" href="/menu">

        管理者メニュー</a>
</li>
@endsection

@section('content')
<div class="my-4 col-md-12">
    @include('export.export')
</div>
@endsection
