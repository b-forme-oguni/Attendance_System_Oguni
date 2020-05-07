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
<script type="text/javascript">
    function set2fig(num) {
        // 桁数が1桁だったら先頭に0を加えて2桁に調整する
        var ret;
        if (num < 10) {
            ret = "0" + num;
        } else {
            ret = num;
        }
        return ret;
    }

    function showClock2() {
        var nowTime = new Date();
        var nowHour = set2fig(nowTime.getHours());
        var nowMin = set2fig(nowTime.getMinutes());
        var nowSec = set2fig(nowTime.getSeconds());
        var msg = nowHour + ":" + nowMin + ":" + nowSec;
        document.getElementById("RealtimeClockArea").innerHTML = msg;
    }
    setInterval('showClock2()', 1000);

</script>
@endsection


@section('userslist')
<ul class="list-group">
    @foreach ($users as $user)
    <li class="list-group-item list-group-item-action">
        {{$user->id . '：' . $user->getName() }}</li>
    @endforeach
</ul>
@endsection

@section('kanaindex')
<ul class="list-group">
    <li class="list-group-item list-group-item-action">ALL</li>
    @foreach ($kanalist as $key=>$value)
    <li class="list-group-item list-group-item-action">

        {{ $key }}</li>

    @endforeach
</ul>
@endsection
