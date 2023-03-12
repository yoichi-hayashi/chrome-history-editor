@extends('layouts.app')

@section('content')
    <h1>乱数ジェネレーター</h1>

    <div class="mt-4">
        <p>入力した範囲から、指定した個数の乱数を昇順で生成します。</p>
        <p>「合計を取る値」に数値が入力されていれば、生成された乱数との合計を右のエリアに表示します。</p>
        <p>「前方固定」「後方固定」に数値が入力されていれば、生成された数字の前方/後方が入力された数値で固定になります。</p>
        <p>「乱数部からの除外」に数値が入力されていれば、前方/後方の固定部を除いた部分から入力された数値が出てこないようにします。</p>
        <p>※ 制約条件として、「範囲」の最小値と最大値は同じ桁数にしてください。</p>
        <p>&emsp;(例) 1000(4桁) ～ 9999(4桁)、10000(5桁) ～ 20000(5桁)</p>
    </div>
    
    {!! Form::open(['route' => 'random-numbers.generate', 'method' => 'GET']) !!}
        
        <div class="mt-4 form-inline">
            <div class="form-group">
                {!! Form::label('min_num', '範囲：') !!}
                {!! Form::text('min_num', null, ['class' => 'form-control']) !!}
            </div>
            <div class="ml-2 form-group">
                {!! Form::label('max_num', '～', ['style' => 'margin-right: 8px;']) !!}
                {!! Form::text('max_num', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        
        <div class="mt-2 form-group form-inline">
            {!! Form::label('count', '個数：') !!}
            {!! Form::text('count', null, ['class' => 'form-control']) !!}
        </div>
        
        <div class="form-group form-inline">
            {!! Form::label('sum_num', '合計を取る値：') !!}
            {!! Form::text('sum_num', null, ['class' => 'form-control']) !!}
        </div>
        
        <div class="form-inline">
            <div class="form-group">
                {!! Form::label('forward_stationary', '前方固定：') !!}
                {!! Form::text('forward_stationary', null, ['class' => 'form-control']) !!}
            </div>
            <div class="ml-4 form-group">
                {!! Form::label('backward_stationary', '後方固定：') !!}
                {!! Form::text('backward_stationary', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        
        <div class="mt-2 form-group form-inline">
            {!! Form::label('exclusion', '乱数部からの除外：') !!}
            {!! Form::text('exclusion', null, ['class' => 'form-control']) !!}
        </div>
        
        <div>
            {!! Form::button('乱数を生成', ['class' => 'btn btn-primary js-generate-button']) !!}
        </div>
        
        <div class="my-4" style="display: flex;">
            <div class="output-area border border-secondary" style="height: 300px; width: 400px; overflow: auto;">
                @if (isset($randomNumbers))
                    @foreach ($randomNumbers as $randomNumber)
                        {{ $randomNumber }} <br>
                    @endforeach
                @endif
            </div>
            <div class="ml-5 addition-area border border-secondary" style="height: 300px; width: 400px; overflow: auto;"></div>
        </div>
        
    {!! Form::close() !!}
    
    <script src="{{ mix('js/ajax.js') }}"></script>
@endsection

