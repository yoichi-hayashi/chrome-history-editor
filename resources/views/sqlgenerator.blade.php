@extends('layouts.app')

@section('content')
    <h2>SQLクエリジェネレーター</h2>
    
    <h4 class="mt-4">レコード削除</h4>
    {!! Form::open(['route' => 'sqlgenerator.get', 'method' => 'get']) !!}
    <div class="mt-3">
        <div class="form-inline">
            <div class="form-group">
                {!! Form::label('from', 'DELETE FROM ', ['style' => 'margin-right: 8px;']) !!}
                {!! Form::select('from', ['visits' => 'visits', 'urls' => 'urls'], 'visits', ['class' => 'form-control']) !!}
            </div>
            <div class="ml-2 form-group">
                {!! Form::label('del_id', 'WHERE id = ', ['style' => 'margin-right: 8px;']) !!}
                {!! Form::text('del_id', null, ['class' => 'form-control', 'style' => 'width: 100px;']) !!}
            </div>
        </div>
        <div class="mt-3 form-inline">
            <div class="form-group">
                {!! Form::label('from_between', 'DELETE FROM ', ['style' => 'margin-right: 8px;']) !!}
                {!! Form::select('from_between', ['visits' => 'visits', 'urls' => 'urls'], 'visits', ['class' => 'form-control']) !!}
            </div>
            <div class="ml-2 form-group">
                {!! Form::label('del_id_between', 'WHERE id BETWEEN ', ['style' => 'margin-right: 8px;']) !!}
                {!! Form::text('del_id_min', null, ['class' => 'form-control', 'style' => 'width: 100px;']) !!}
            </div>
            <div class="ml-2">AND</div>
            <div class="ml-2 form-group">
                {!! Form::text('del_id_max', null, ['class' => 'form-control', 'style' => 'width: 100px;']) !!}
            </div>
        </div>
    </div>
    
    <div class="mt-3">
        <h4>ページ遷移元修正</h4>
        <div class="mt-3 form-inline">
            <div class="form-group">
                {!! Form::label('from_visit', 'UPDATE visits SET from_visit = from_visit － ', ['style' => 'margin-right: 8px;']) !!}
                {!! Form::text('from_visit', null, ['class' => 'form-control', 'style' => 'width: 100px;']) !!}
            </div>
            <div class="ml-2 form-group">
                {!! Form::label('from_visit_id', 'WHERE id = ', ['style' => 'margin-right: 8px;']) !!}
                {!! Form::text('from_visit_id', null, ['class' => 'form-control', 'style' => 'width: 100px;']) !!}
            </div>
        </div>
        <div class="mt-3 form-inline">
            <div class="form-group">
                {!! Form::label('from_visit_between', 'UPDATE visits SET from_visit = from_visit －  ', ['style' => 'margin-right: 8px;']) !!}
                {!! Form::text('from_visit_between', null, ['class' => 'form-control', 'style' => 'width: 100px;']) !!}
            </div>
            <div class="ml-2 form-group">
                {!! Form::label('from_visit_id_between', 'WHERE id BETWEEN ', ['style' => 'margin-right: 8px;']) !!}
                {!! Form::text('from_visit_min', null, ['class' => 'form-control', 'style' => 'width: 100px;']) !!}
            </div>
            <div class="ml-2">AND</div>
            <div class="ml-2 form-group">
                {!! Form::text('from_visit_max', null, ['class' => 'form-control', 'style' => 'width: 100px;']) !!}
            </div>
        </div>
    </div>

    <div class="mt-3">
        <h4>閲覧時刻修正</h4>
        <div class="mt-3 form-inline">
            <div class="form-group">
                {!! Form::label('visit_time', 'UPDATE visits SET visit_time = ', ['style' => 'margin-right: 8px;']) !!}
                {!! Form::text('visit_time', null, ['class' => 'form-control', 'style' => 'width: 100px;']) !!}
            </div>
            <div class="ml-2 form-group">
                {!! Form::label('visits_id', 'WHERE id = ', ['style' => 'margin-right: 8px;']) !!}
                {!! Form::text('visits_id', null, ['class' => 'form-control', 'style' => 'width: 100px;']) !!}
            </div>
        </div>
        
        <div class="mt-3 form-inline">
            <div class="form-group">
                {!! Form::label('last_visit_time', 'UPDATE urls SET last_visit_time = ', ['style' => 'margin-right: 8px;']) !!}
                {!! Form::text('last_visit_time', null, ['class' => 'form-control', 'style' => 'width: 100px;']) !!}
            </div>
            <div class="ml-2 form-group">
                {!! Form::label('urls_id', 'WHERE id = ', ['style' => 'margin-right: 8px;']) !!}
                {!! Form::text('urls_id', null, ['class' => 'form-control', 'style' => 'width: 100px;']) !!}
            </div>
        </div>
    </div>
    
    <div class="mt-3">
        <h4>ページ滞在時間修正</h4>
        <div class="mt-3 form-inline">
            <div class="form-group">
                {!! Form::label('until_time', 'UPDATE visits SET visit_duration = ', ['style' => 'margin-right: 8px;']) !!}
                {!! Form::text('until_time', null, ['class' => 'form-control', 'style' => 'width: 100px;']) !!}
            </div>
            <div class="ml-1 form-group">
                {!! Form::label('from_time', '－ ', ['style' => 'margin-right: 8px;']) !!}
                {!! Form::text('from_time', null, ['class' => 'form-control', 'style' => 'width: 100px;']) !!}
            </div>
            <div class="ml-2 form-group">
                {!! Form::label('visit_duration_id', 'WHERE id = ', ['style' => 'margin-right: 8px;']) !!}
                {!! Form::text('visit_duration_id', null, ['class' => 'form-control', 'style' => 'width: 100px;']) !!}
            </div>
        </div>
    </div>
    
    <div class="mt-3">
        <h4>オートインクリメント修正</h4>
        <div class="mt-3 form-inline">
            SELECT * FROM sqlite_sequence;
            <div class="ml-2 form-group">
                {!! Form::button('追加', ['class'=>'btn btn-success js-add-button']) !!}
            </div>
        </div>
        
        <div class="mt-3 form-inline">
            <div class="form-group">
                {!! Form::label('sequence_fix', 'UPDATE sqlite_sequence SET seq = seq － ', ['style' => 'margin-right: 8px;']) !!}
                {!! Form::text('sequence_fix', null, ['class' => 'form-control', 'style' => 'width: 100px;']) !!}
            </div>
            <div class="ml-2 form-group">
                {!! Form::label('sequence_name', 'WHERE name = ', ['style' => 'margin-right: 8px;']) !!}
                {!! Form::select('sequence_name', ["'visits'" => "'visits'", "'urls'" => "'urls'"], "'visits'", ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>
    
    <div class="mt-4 form-inline">
        <div class="js-output-area"></div>
        <div class="mt-4 form-inline">
            <div class="ml-3 form-group">
                {!! Form::button('生成', ['class'=>'btn btn-primary js-generate-button']) !!}
            </div>
            <div class="ml-2 form-group">
                {!! Form::button('削除', ['class'=>'btn btn-danger js-delete-button']) !!}
            </div>
        </div>
    </div>
        
    <div class="mt-3 form-group form-inline">
        {!! Form::button('エクスポート', ['class'=>'btn btn-success js-export-button']) !!}
    </div>
    {!! Form::close() !!}
    
    <script src="{{ mix('js/sqlgenerator.js') }}"></script>
@endsection