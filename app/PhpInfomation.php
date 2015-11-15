<?php

namespace App;

class PhpInfomation
{
    /**
     * xDebugが有効か
     * @return bool 有効(true)/無効(false)
     */
    public static function isxDebugMode()
    {
        return empty(shell_exec('php -i |grep "debug support"'))?false:true;
    }
}
