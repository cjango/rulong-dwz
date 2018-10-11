<?php

namespace RuLong\Panel;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Str;

class BladeExtends
{

    public static function ueditor()
    {
        Blade::directive('ueditor', function ($context) {
            $parse     = explode(',', $context);
            $content   = $parse[0] ?? '';
            $name      = $parse[1] ?? 'content';
            $elementId = $parse[2] ?? 'uEditor';

            $editor = '<script id="' . self::stripParentheses($elementId) . '" name="' . self::stripParentheses($name) . '" type="text/plain">';
            $editor .= '<?php echo (' . self::stripParentheses($content) . '); ?>';
            $editor .= '</script>';
            $editor .= '<script type="text/javascript">';
            $editor .= 'var ue = UE.getEditor("' . self::stripParentheses($elementId) . '", {autoHeightEnabled:false,initialFrameHeight:400,zIndex:100,saveInterval:10000,serverUrl:"' . route('RuLong.ueditor.server', ['_token' => csrf_token()]) . '"});';
            $editor .= '</script>';
            return $editor;
        });
    }

    private static function stripParentheses($expression)
    {
        $expression = trim($expression);

        if (Str::startsWith($expression, '"') || Str::startsWith($expression, "'")) {
            $expression = substr($expression, 1, -1);
        }

        return $expression;
    }

}
