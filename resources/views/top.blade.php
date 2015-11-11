@extends('layouts.master')

@section('title', 'ツール集')

{{-- Javascript --}}
@section('local_javascript')
    <script type="text/javascript">
        $("#id_switch").click(function() { window.location.href = '/switchdebugmode'; });
        $("#id_phpinfo").click(function() { window.open('http://dev.watanabetools/phpinfo'); });
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

{{------------------------- phpinfo ---------------------------------}}
@section('phpinfo')
    <p>
        PHPINFO&nbsp;:&nbsp;
        <button type="button" class="btn btn-success" id="id_phpinfo">Go!</button>
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
    @foreach($local_branch_list as $branch_name)
        <p>
        </p>
    @endforeach
@endsection

{{------------------------- remotebranch名 ---------------------------------}}
@section('remotebranch')
    <p>
    </p>
@endsection

{{----------------------------全体-----------------------------------}}
@section('content')
    <p>Tools</p>
    <hr>
    @yield('debugmode')
    <hr>
    @yield('phpinfo')
    <hr>
    @yield('branchname')
@endsection
