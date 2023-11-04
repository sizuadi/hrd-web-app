<?php

namespace App\Helpers;

class GlobalHelpers
{
    public static function toastifyShow($text, $duration, $type){
        switch ($type) {
            case 'success':
                $color =
                break;
            case 'warning':
                # code...
                break;
            case 'danger':
                # code...
                break;
            case 'info':
                # code...
                break;

            default:
                # code...
                break;
        }
        $data = [
            'text' => $text,
            'duration' => $duration ?? 3000,
            'close' => true,
            'gravity' => "top",
            'position' => "right",
            'color' => "#f3616d",
        ];
    }
}
