@extends('layouts.stamp_base')
@section('title',$school->getName() . 'タイムカード')

@section('breadcrumb')
<nav aria-label="breadcrumb col-md-12">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Top</a></li>
        <li class="breadcrumb-item active" aria-current="page">打刻画面</li>
    </ol>
</nav>
@endsection

@section('schoolname')
<p class="schoolname">

    {{ $school->getName()}}</p>
@endsection

@section('date')
<p class="todaydate">

    {{ $today }}</p>
@endsection

@section('timer')
<p class="timer display-1" id="RealtimeClockArea">00:00:00</p>
@endsection

@section('userarea')
@if (isset($personal))
<p class="username">
    <span class="display-4">

        {{ $personal['name'] }}</span>さん
</p>
<div class="stampbox">

    @if ( !array_key_exists ($personal['id'], $attendlist) )
    {{-- 出席ボタンの表示 --}}
    <form action="start/{{ $school->id }}" method="POST">

        {{ csrf_field() }}
        <input type="hidden" name="user_id" value="{{ $personal['id'] }}">
        <input type="submit" value=" IN " class="button round">

    </form>
    @elseif ( $attendlist[$personal['id']] == true )
    {{-- 退席ボタンの表示 --}}
    <form action="end/{{ $school->id }}" method="POST">

        {{ csrf_field() }}
        <input type="hidden" name="user_id" value="{{ $personal['id'] }}">
        <input type="submit" value="OUT" class="button round">

    </form>
    @else
    <p class="msg"> 本日はお疲れ様でした！</p>
    <p class="msg">右リストから利用者名を選択して下さい </p>

    @endif
</div>

@else
<div class="stampbox">
    <p class="msg">右リストから利用者名を選択して下さい </p>
</div>
@endif
@endsection

@section('userslist')
@foreach ($users as $user)
<a href="{{ url()->full()}}&id={{ $user->id }}" class="d-flex justify-content-between list-group-item list-group-item-action">
    <dl class="namebox d-inline-block">
        <dt class="namebox_id d-inline-block text-right">

            {{ $user->id }}：</dt>

        <dd class="namebox_name d-inline-block">

            {{ $user->getName() }}</dd>
    </dl>

    @if ( array_key_exists ($user->id , $attendlist ) )

    @if ( $attendlist[$user->id] == true )
    <p class="namebox_attend_in d-inline-block text-center">

        出席中</p>
    @else
    <p class="namebox_attend_out d-inline-block text-center">

        退席済</p>
    @endif
    @endif

</a>
@endforeach
@endsection

@section('kanaindex')
<a href="{{ $school->id }}?index=all" class="list-group-item list-group-item-action">ALL</a>
@foreach ($kanalist as $key=>$value)
<a href="{{ $school->id }}?index={{ urlencode($key) }}" class="list-group-item list-group-item-action">

    {{ $key }}</a>
@endforeach
@endsection
