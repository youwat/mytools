<?php

namespace App\Http\Controllers;

use App\PhpInfomation;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Dao\LogData;
use App\Common;
use App\Git;

class TopController extends Controller
{
    // デバッグモードスイッチ用 自動リダイレクト時間(単位:秒)
    const AUTO_REDIRECT_INTERVAL_TIME = 5;
    // 自動更新頻度(単位:秒)
    const AUTO_UPDATE_INTERVAL_TIME = 150;
    const TAB_DASH_BOARD_NUMBER = 1;
    const TAB_LOG_NUMBER = 2;

    public function __construct()
    {
    }

    /**
     * Tool Top
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAction()
    {
        // Git情報取得クラス
        $git = new Git("/home/watanabe/AMS_GIT");

        // Tab1 -----------------------------------------------------
        // デバッグモード取得
        $data['x_debug'] = PhpInfomation::isxDebugMode();
        // 現在のブランチ名の取得
        $data['branch_name'] = $git->getBranchName();
        // ローカルブランチ一覧取得
        $data['local_branch_list'] = $git->getBranchList(true);
        // リモートブランチ一覧取得
        $data['remote_branch_list'] = $git->getBranchList(false);
        // デフォルト選択タブ
        $data['default_tab_number'] = self::TAB_DASH_BOARD_NUMBER;

        // Tab2 -----------------------------------------------------
        // 100件までログをデータベースから取得



        // 現在時刻
        $data['now'] = Common::getDateString();

        return view('top', $data);
    }

    public function switchDebugAction()
    {
        $auto_redirect_interval_time = \Config::get('mytools.auto_redirect_interval_time');

        $cmd = "sudo switchdebugmode.sh";
        $data = array('wait' => $auto_redirect_interval_time);
        shell_exec($cmd);
        return view('switchdebug', $data);
    }
}
