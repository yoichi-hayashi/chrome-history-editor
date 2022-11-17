@extends('layouts.app')

@section('content')
    <h2>ログ登録</h2>
    {!! Form::open(['route' => 'log.store']) !!}
    <div class="mt-4 mb-4 form-group form-inline">
        {!! Form::textarea('log_content', null, ['class' => 'form-control']) !!}
        {!! Form::button('保存', ['class' => 'btn btn-primary', 'data-toggle' => 'modal', 'data-target' => '#modalForm']) !!}
        <div class="modal fade" id="modalForm" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <!-- Modal ヘッダー -->
              <div class="modal-header">
                　<h5 class="modal-title" id="Modal">ログ登録</h5>
                <button type="button" class="close" data-dismiss="modal">
                  <span aria-hidden="true">×</span>
                  <span class="sr-only">キャンセル</span>
                </button>
              </div>
                <!-- Modal ボディー -->
                <div class="modal-body">
                  <label>ログ名</label>
    
                  <div class="form-group">
                    {!! Form::text('log_name', null, []) !!}　　
                  </div>
                </div>
                
                <!-- Modal ボディー -->
                <div class="modal-body">
                  <label>コンテンツ日時</label>
    
                  <div class="form-group">
                    <input type="datetime-local" id="content_time" name="content_time" value="{{ \Carbon\Carbon::now()->format("Y-m-d H:i") }}">
                  </div>
                </div>
                
                <!-- Modal フッター -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">キャンセル
                  </button>
                  {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
          </div>
        </div>
    {!! Form::close() !!}
    </div>
    
    <h2>ログ検索</h2>
    {!! Form::open(['route' => 'log.search', 'method' => 'get']) !!}
    <div class="mt-4 ml-4 form-group form-inline">
        {!! Form::label('name_explore', 'ファイル名検索：') !!}
        {!! Form::text('name_explore', null, ['class' => 'form-control']) !!}
    </div>
    
    <div class="mt-2 ml-4 form-group form-inline">
        {!! Form::label('time_explore', '日時検索：') !!}
        <input type="datetime-local" id="from_date" name="from_date">
        ～
        <input type="datetime-local" id="until_date" name="until_date">
        {!! Form::submit('実行', ['class' => 'btn btn-primary']) !!}
    </div>
    
    @if (isset($logs))
    <div class="mt-4 form-group form-inline">
      <ul class="list-group">
        @foreach ($logs as $log)
        <li class="card list-group-item">
          <div class="card-title">ログ名：{{ $log->log_name }} <span class="pl-3">{{ $log->content_time }}</span></div>
          <div class="card-text">
            <div>コンテンツ内容：</div>
            <div>{{ $log->log_content }}</div>
          </div>
        </li>
        @endforeach
      </ul>
    </div>
    @endif
    
    {!! Form::close() !!}
@endsection