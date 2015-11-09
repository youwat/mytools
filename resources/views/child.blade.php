@extends('layouts.master')

@section('title', 'Page Title')

@section('sidebar')
    @parent
    <p>ここはマスターサイドバーに追加される</p>
@endsection

@section('content')
    <p>ここが本文のコンテンツ</p>
@endsection
