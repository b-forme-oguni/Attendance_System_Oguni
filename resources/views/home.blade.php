@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
            <div class="alert alert-success" role="alert">

                {{ session('status') }}
            </div>
            @endif
            <h2 class="text-center">ログインしました</h2>


        </div>
    </div>
</div>
@endsection
