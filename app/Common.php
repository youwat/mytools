<?php

namespace App;

class Common
{
    const DATETIME_FORMAT = "Y年m月d日 h:i:s";

    /**
     * @param null $dateFormat
     * @return bool|string
     */
    public static function getDateString($dateFormat=null){
        if(is_null($dateFormat)) {
            $ret = date(self::DATETIME_FORMAT, time());
        } else {
            $ret = date($dateFormat, time());
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
                $this->trim($v);
            }unset($v);
        } else {
            if(is_string($target)) {
                $target = trim($target);
            }
        }
    }
}
