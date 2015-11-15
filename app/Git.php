<?php

namespace App;

class Git
{
    protected $homeDir;
    protected $isInit = false;

    /**
     * Git constructor.
     * @param null $homeDir ホームディレクトリ
     */
    function __construct($homeDir = null){
        if(!$homeDir) return;

        $this->initialize($homeDir);
    }
    /**
     * 初期化
     * @param $homeDir Gitのホームディレクトリ
     */
    public function initialize($homeDir)
    {
        $this->isInit = true;
        $this->homeDir = $homeDir;
    }

    /**
     * 現在のブランチ名を取得する
     * @return mixed|string ブランチ名
     * @throws \Exception
     */
    public function getBranchName()
    {
        if(!$this->isInit) throw new \Exception("from Git class「You should call initialize method」");

        $cmd = $this->createValidGitCommand("git status|head -1;");
        $ret = shell_exec($cmd);
        $ret = str_replace('On branch ', '', $ret);

        return $ret;
    }

    /**
     * ブランチリストを取得する
     * @param $isLocal ローカルブランチ情報ならtrue/リモートブランチ情報ならfalse
     * @return array ブランチ名の配列
     * @throws \Exception
     */
    public function getBranchList($isLocal)
    {
        if(!$this->isInit) throw new \Exception("from Git class「You should call initialize method」");

        if($isLocal) {
            // ローカルブランチリストを取得
            $cmd = $this->createValidGitCommand("git branch");
            $tmp = shell_exec($cmd);
            $ret = explode("\n", $tmp);
        }else {
            // リモートブランチリストを取得
            $cmd = $this->createValidGitCommand("git branch -a");
            $tmp = shell_exec($cmd);
            $tmp = explode("\n", $tmp);
            $ret = $tmp;
            foreach($tmp as $k => $v) {
                if(strpos($v, 'remotes') === false) {
                    unset($ret[$k]);
                }
            }
        }
        // 空文字の要素削除
        if(is_array($ret)) {
            $tmp = array(); foreach($ret as $v) { if(!empty($v)) { $tmp[] = $v; } }
            $ret = $tmp;
        }

        return $ret;
    }

    /**
     * ホームディレクトリに移動するコマンドを追加する
     * @param $command gitに関するコマンド
     * @return string
     */
    private function createValidGitCommand($command)
    {
        return 'cd ' . $this->homeDir . ';' . $command;
    }
}
