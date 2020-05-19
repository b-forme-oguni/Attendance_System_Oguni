@extends('layouts.common_base')
@section('title','出欠管理システムTOP')

@section('content')
@foreach ($schools as $school)
<a class="button square" href="stamp/{{ $school->id }}?index=all">

    {{ $school->getlName() }}</a>

@endforeach
@endsection

@section('footer')
<a class="button square_min" href="login">

    管理者ログイン</a>
@endsection
