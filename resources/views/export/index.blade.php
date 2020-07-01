@extends('layouts.common_base')
@section('title', date('Y', strtotime($year_month)) . '年'. date('n', strtotime($year_month)) . '月の実務記録出力対象者')

@section('header_record_school')
<form action="output" method="GET" class="d-flex">
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
<div class="container mt-4">
    <h2 class="text-center">@yield('title')</h2>
    <div class="my-4 col-md-12">
        @if (isset($records))
        <div class="d-flex">
            <ul class="list-unstyled w-25">
                @for ($i = 1; $i <= count($records); $i++) <li>
                    <a href="/output/preview?id={{ $records[$i - 1]->user_id}}&date={{ $year_month }}">

                        {{ $records[$i - 1]->user_id}}：

                        {{ $records[$i - 1]->user->getName() }}
                    </a>
                    </li>
                    @if (empty($i % 20))
                    @if ($i % count($records))
            </ul>
            <ul class="list-unstyled w-25">
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
</div>
@endsection
