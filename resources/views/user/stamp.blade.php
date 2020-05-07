@extends('layouts.stamp_base')
@section('title',$school->getlName() . 'タイムカード')

@section('schoolname')
<p>

    {{ $school->getlName()}}</p>
@endsection

@section('userslist')

<ul class="list-group">
    @foreach ($users as $user)
    <li class="list-group-item list-group-item-action">

        {{ $user->id }} .

        {{ $user->getName() }}</li>

    @endforeach
</ul>
@endsection

@section('paginate')

{{ $users->links() }}
@endsection
