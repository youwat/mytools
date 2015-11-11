<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TopController extends Controller
{
    // 自動更新頻度(単位:分)
    const AUTO_UPDATE_INTERVAL_TIME = 5;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // デバッグモード取得
        $data['x_debug'] = $this->isxDebugMode();
        // 現在のブランチ名の取得
        $data['branch_name'] = $this->getBranchName();
        $this->trim($data['branch_name']);
        // ローカルブランチ一覧取得
        $data['local_branch_list'] = $this->getBranchList(true);
        $this->trim($data['local_branch_list']);
        // リモートブランチ一覧取得
        $data['remote_branch_list'] = $this->getBranchList(false);
        $this->trim($data['remote_branch_list']);

        return view('top', $data);
    }

    public function switchDebug()
    {
        $cmd = "sudo switchdebugmode.sh";
        $data = array('wait' => self::AUTO_UPDATE_INTERVAL_TIME);
        shell_exec($cmd);
        return view('switchdebug', $data);
    }

    /**
     * xDebugが有効か
     * @return bool 有効(true)/無効(false)
     */
    protected function isxDebugMode()
    {
        return empty(shell_exec('php -i |grep "debug support"'))?false:true;
    }

    /**
     * 現在のブランチ名を取得する
     * @return mixed|string ブランチ名
     */
    protected function getBranchName()
    {
        $ret = shell_exec("cd /home/watanabe/AMS_GIT;git status|head -1;");
        $ret = str_replace('On branch ', '', $ret);

        return $ret;
    }

    /**
     * ブランチリストを取得する
     * @param $isLocal
     * @return array
     */
    private function getBranchList($isLocal)
    {
        $ret = array();
        if($isLocal) {
            // ローカルブランチリストを取得
            $cmd = "cd /home/watanabe/AMS_GIT;git branch";
            $tmp = shell_exec($cmd);
            $ret = explode("\n", $tmp);
        }else {
            // リモートブランチリストを取得
            $cmd = "cd /home/watanabe/AMS_GIT;git branch -a";
            $tmp = shell_exec($cmd);
            $tmp = explode("\n", $tmp);
            $ret = $tmp;
            foreach($tmp as $k => $v) {
                if(strpos($v, 'remotes') === false) {
                    unset($ret[$k]);
                }
            }
        }

        return $ret;
    }

    /**
     * 余分な文字を除去
     * @param $target 文字列or文字列配列
     */
    private function trim(&$target)
    {
        if(empty($target)) return;

        if(is_array($target)) {
            foreach($target as &$v) {
                $v = trim($v);
            }unset($v);
        } else {
            $target = trim($target);
        }
    }
}
