<?php

namespace RuLong\Panel\Controllers\Traits;

trait AjaxResponse
{

    protected function success($message = '', $callbackType = null, $refTab = null)
    {
        $return = [
            'statusCode' => 200,
            'message'    => $message ?: '操作成功',
        ];
        if (is_string($callbackType)) {
            $return['callbackType'] = 'closeCurrent';
        } elseif (is_array($callbackType)) {
            $return['callbackType'] = 'forward';
            $return['forwardUrl']   = $callbackType[0];
        }
        if (!is_null($refTab)) {
            $return['navTabId'] = $refTab;
        }
        return $return;
    }

    protected function error($message = '', $callbackType = null, $refTab = null, $statusCode = 400)
    {
        $return = [
            'statusCode' => $statusCode,
            'message'    => $message ?: '操作失败',
        ];
        if (is_string($callbackType)) {
            $return['callbackType'] = 'closeCurrent';
        } elseif (is_array($callbackType)) {
            $return['callbackType'] = 'forward';
            $return['forwardUrl']   = $callbackType[0];
        }
        if (!is_null($refTab)) {
            $return['navTabId'] = $refTab;
        }
        return $return;
    }
}
