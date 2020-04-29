@extends('layouts.stamp_base')
@section('title',$school->getlName() . 'タイムカード')

@section('content')


<div>
    <p>

        {{ $school->getlName()}}</p>
</div>

<div>
    <ul>
        @foreach ($users as $user)
        <li>

            {{ $user->id }} .

            {{ $user->getName() }}</li>

        @endforeach
    </ul>
</div>
@endsection
