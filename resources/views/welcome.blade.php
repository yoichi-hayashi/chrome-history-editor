@extends('layouts.app')

@section('content')
    @if (Auth::check())
        {{ Auth::user()->name }}
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Chrome History Editor</h1>
            </div>
        </div>
        <div class="row">
            <div class="d-grid gap-2 col-2 mx-auto">
                <div class="mb-4">
                    {{-- ログインページへのリンク --}}
                    {!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-primary w-100']) !!}
                </div>
                <div>
                    {{-- ユーザ登録ページへのリンク --}}
                    {!! link_to_route('signup.get', '新規登録', [], ['class' => 'btn btn-primary w-100']) !!}
                <div>
            </div>
        </div>
    @endif
@endsection