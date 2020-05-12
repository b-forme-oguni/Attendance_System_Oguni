@extends('layouts.stamp_base')
@section('title',$school->getlName() . 'タイムカード')

@section('schoolname')
<p class="schoolname">

    {{ $school->getlName()}}</p>
@endsection

@section('date')
<p class="todaydate">

    {{ $today }}</p>
@endsection

@section('timer')
<p class="timer display-1" id="RealtimeClockArea">00:00:00</p>
@endsection

@section('userarea')
@if ($personal)
<p class="username">
    <span class="display-4">

        {{ $personal->getName() }}</span>さん
</p>

<form action="{{ $school_id }}" method="POST">

    {{ csrf_field() }}
    <input type="hidden" name="user_id" value="{{ $personal->id }}">
    <input type="submit" value="IN" class="button">

</form>


@else
<p class="username">
    右リストから利用者名を選択して下さい
</p>
@endif
@endsection

@section('userslist')
@foreach ($users as $user)
<a href="{{ $school_id }}?id={{ $user->id }}" class="list-group-item list-group-item-action">
    {{$user->id . '：' . $user->getName() }}</a>
@endforeach
@endsection

@section('kanaindex')
<a href="{{ $school_id }}" class="list-group-item list-group-item-action">ALL</a>
@foreach ($kanalist as $key=>$value)
<a href="{{ $school_id }}?index={{ urlencode($key) }}" class="list-group-item list-group-item-action">

    {{ $key }}</a>
@endforeach
@endsection
