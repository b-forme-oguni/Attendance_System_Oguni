@extends('layouts.common_base')
@section('title','出欠管理システムTOP')

@section('content')

<ul>
    @foreach ($schools as $school)
    <li><a href="stamp/{{ $school->id }}">

            {{ $school->getlName() }}</a></li>

    @endforeach
</ul>

@endsection
