<?php

namespace App\Helpers;

use Livewire\Component;

class GlobalHelpers extends Component
{
    public static function toastifySuccess($text, $duration = null)
    {
        $data = [
            'text' => $text,
            'duration' => $duration ?? 3000,
            'close' => true,
            'gravity' => "top",
            'position' => "right",
            'color' => "#198754",
            'avatar' => "assets/img/icons/check.svg",
        ];


        return ['toastify', $data];
    }

    public static function toastifyWarning($text, $duration = null)
    {
        $data = [
            'text' => $text,
            'duration' => $duration ?? 3000,
            'close' => true,
            'gravity' => "top",
            'position' => "right",
            'color' => "#ca8a04",
            'avatar' => "assets/img/icons/alert-circle.svg",
        ];

        return ['toastify', $data];
    }

    public static function toastifyDanger($text, $duration = null)
    {
        $data = [
            'text' => $text,
            'duration' => $duration ?? 3000,
            'close' => true,
            'gravity' => "top",
            'position' => "right",
            'color' => "#dc3545",
            'avatar' => "assets/img/icons/alert-circle.svg",
        ];

        return ['toastify', $data];
    }

    public static function toastifyInfo($text, $duration = null)
    {
        $data = [
            'text' => $text,
            'duration' => $duration ?? 3000,
            'close' => true,
            'gravity' => "top",
            'position' => "right",
            'color' => "#0dcaf0",
            'avatar' => "assets/img/icons/info.svg",
        ];

        return ['toastify', $data];
    }
}
