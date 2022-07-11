@extends('layouts.app')

@section('content')
    <h1>乱数ジェネレーター</h1>

    <div class="mt-4">
        <p>範囲と個数から乱数を計算して生成します。</p>
        <p>入力された範囲から、指定された個数の乱数を昇順で生成します。</p>
        <p>「合計を取る値」に数値が入力されていれば、生成された乱数との合計を右のエリアに表示します。</p>
        <p>「前方固定」「後方固定」に数値が入力されていれば、生成された数字の前方/後方が入力された数値で固定になります。</p>
        <p>「乱数部からの除外」に数値が入力されていれば、前方/後方の固定部を除いた部分から入力された数値が出てこないようにします。</p>
    </div>
    
    {!! Form::open(['route' => 'random-numbers.generate', 'method' => 'GET']) !!}
        
        <div class="mt-4 form-inline">
            <div class="form-group">
                {!! Form::label('from_num', '範囲：') !!}
                {!! Form::text('from_num', null, ['class' => 'form-control']) !!}
            </div>
            <div class="ml-2 form-group">
                {!! Form::label('to_num', '～') !!}
                {!! Form::text('to_num', null, ['class' => 'form-control']) !!}
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
                {!! Form::label('forward_fix', '前方固定：') !!}
                {!! Form::text('forward_fix', null, ['class' => 'form-control']) !!}
            </div>
            <div class="ml-4 form-group">
                {!! Form::label('backward_fix', '後方固定：') !!}
                {!! Form::text('backward_fix', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        
        <div class="mt-2 form-group form-inline">
            {!! Form::label('exclusion', '乱数部からの除外：') !!}
            {!! Form::text('exclusion', null, ['class' => 'form-control']) !!}
        </div>
        
        <div>
            {!! Form::submit('乱数を生成', ['class' => 'btn btn-primary']) !!}
        </div>
        
        <div class="mt-4 form-inline">
            <div class="form-group">
                {!! Form::textarea('result', null, ['class' => 'form-control']) !!}
            </div>
            <div class="ml-5 form-group">
                {!! Form::textarea('sum_num_result', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        
    {!! Form::close() !!}
@endsection

