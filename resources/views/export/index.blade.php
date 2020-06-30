@extends('layouts.common_base')
@section('title','管理者メニュー')

@section('header_record_school')

<form action="/output/index" method="GET" class="d-flex">
    <dl class="d-flex align-items-center">
        <dt>
            所属：</dt>
        <dd>

            {{ Form::select('school_id', $schoolselect, $school_id, ['class' => 'form-control', 'onChange' => 'submit(this.form)']) }}
        </dd>
    </dl>
    <dl class="d-flex align-items-center">
        <dt>
            年月：</dt>
        <dd>
            <input type="month" name="date" value={{ $year_month }} class="form-control" onChange='submit(this.form)'>
        </dd>
    </dl>
</form>
@endsection

@section('header_admin_menu')
<li>
    <a class="button square_min" href="/menu">

        管理者メニュー</a>
</li>
@endsection

@section('content')
<div class="my-5 col-md-12">
    @if (isset($records))
        <div class="d-flex justify-content-start">
            <ul>
                @for ($i = 1; $i <= count($records); $i++)
                    <li>
                        <a href="/output/preview?id={{ $records[$i - 1]->user_id}}&date={{ $year_month }}">
                        {{ $records[$i - 1]->user_id}}：{{ $records[$i - 1]->user->getName() }}
                        </a>
                    </li>
                    @if (empty($i % 20))
                        @if ($i % count($records))
                    </ul>
                    <ul>
                    @endif
                @endif
                @endfor
            </ul>
        </div>
        <div class="mt-3">
            {{ $records->appends(['school_id' => $school_id,'year_month' => $year_month])->links() }}
        </div>
    @endif

</div>
@endsection
