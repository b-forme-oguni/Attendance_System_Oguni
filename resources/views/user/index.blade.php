@extends('layouts.common_base')
@section('title','出欠管理システムTOP')

@section('content')

<div class="list-group">
    @foreach ($schools as $school)
    <a class="list-group-item list-group-item-action" href="stamp/{{ $school->id }}">

            {{ $school->getlName() }}</a>

    @endforeach
</div>

@endsection
