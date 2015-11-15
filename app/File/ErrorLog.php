<?php

namespace App;

class ErrorLog
{
    /**
     * ErrorLog constructor.
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * ログを取得
     * @param $startLine 開始位置
     * @param $endLine 終了位置
     * @return array
     */
    public function getLog($startLine, $endLine)
    {
        $ret = array();
        // 読み取った最後の行番号
        $ret['readLine'] = 0;


        // ファイルを取得
        $file = file_get_contents($this->filePath);
        return $ret;
    }


    public function tailLog($line)
    {
        $ret = array();

        if(file_exists($this->filePath) === false) {
            return $ret;
        }
        $cmd = 'cd ' . dirname($this->filePath);
        $cmd .= ';' . 'tail -' . $line . ' ' . $this->filePath;
        $ret = shell_exec($cmd);

        return $ret;
    }
}
