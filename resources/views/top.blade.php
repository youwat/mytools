@extends('layouts.master')

@section('title', 'ツール集')

{{-- Javascript --}}
@section('local_javascript')
    <script type="text/javascript">
        $("#id_switch").click(function() { window.location.href = '/switchdebugmode'; });
        $("#id_phpinfo").click(function() { window.open('http://dev.watanabetools/phpinfo'); });
        $("#id_atom").click(function() { window.open('http://dev.atomtools.local'); });
    </script>
@endsection

{{------------------------ デバッグモード ---------------------------}}
@section('debugmode')
    <p>デバッグモード&nbsp;:&nbsp
        <?php if($x_debug) : ?> <span class="text-danger">有効</span>
        <?php else : ?> <span>無効</span>
        <?php endif ?>
        &nbsp;|&nbsp; <button type="button" class='btn btn-danger' id="id_switch">switch!</button>
    </p>
@endsection

{{------------------------- リンク集 ---------------------------------}}
@section('phpinfo')
    <p>
        PHPINFO&nbsp;:&nbsp;
        <button type="button" class="btn btn-success" id="id_phpinfo">Go!</button>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        開発環境ATOM&nbsp;:&nbsp;
        <button type="button" class="btn btn-success" id="id_atom">Go!</button>
    </p>
@endsection

{{-------------------- 現在のbranch名 ---------------------------------}}
@section('branchname')
    @if($branch_name === 'master')
        <p> 現在のブランチ名&nbsp;:&nbsp;<span class="text-danger">{{ $branch_name }}</span> </p>
    @else
        <p> 現在のブランチ名&nbsp;:&nbsp;{{ $branch_name }} </p>
    @endif
@endsection

{{------------------------- branch名 ---------------------------------}}
@section('localbranch')
    local&nbsp;:&nbsp;
    <select name="branch">
        @foreach($local_branch_list as $branch_name)
            @if(!empty($branch_name))
                <option value="{{$branch_name}}">{{$branch_name}}</option>
            @endif
        @endforeach
    </select>
    <br />
@endsection

{{------------------------- remotebranch名 ---------------------------------}}
@section('remotebranch')
    remote :
    <select name="remotebranch">
        @foreach($remote_branch_list as $branch_name)
            <option value="{{$branch_name}}">{{$branch_name}}</option>
        @endforeach
    </select>
@endsection

{{-------------------------------- log -----------------------------------------}}
@section('log')
@endsection

{{-- タブ1(Tools) --}}
@section('tab1')
    <div class="tab-pane fade in active" id="tab1">
        <hr>
        @yield('debugmode')
        <hr>
        @yield('phpinfo')
        <hr>
        @yield('branchname')
        <hr>
        @yield('localbranch')
        @yield('remotebranch')
        <hr>
        <span><a href="/" class="text-success"><u>最終更新日</u></a>&nbsp;:&nbsp;{{ $now }}</span>
    </div>
@endsection

{{-- タブ2(log) --}}
@section('tab2')
    <div class="tab-pane fade" id="tab2">
        <textarea name="log_list" id="loglist" cols="55" rows="10"></textarea>
        <br>
        <span><a href="/?page=2" class="text-success"><u>最終更新日</u></a>&nbsp;:&nbsp;{{ $now }}</span>
    </div>
@endsection

{{----------------------------全体-----------------------------------}}
@section('local_head')
    <meta http-equiv="refresh" content="120;URL=http://dev.mytools/">
@endsection
@section('content')
    <!-- タブの設定 -->
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab1" data-toggle="tab">dash board</a></li>
        <li><a href="#tab2" data-toggle="tab">log</a></li>
    </ul>
    <!-- / タブ-->
    <div id="myTabContent" class="tab-content">
        @yield('tab1')
        @yield('tab2')
    </div>
@endsection
