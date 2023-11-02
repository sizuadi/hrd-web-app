<?php

namespace App\Helpers;

use Livewire\Component;

class Toastify extends Component
{
    public $text;
    public $duration = 3000;
    public $close = true;
    public $gravity = "top";
    public $position = "right";
    public $color;

    public function __construct($configs)
    {
        $this->text = isset($configs['text']) ? $configs['text'] : $this->text;
        $this->duration = isset($configs['duration']) ? $configs['duration'] : $this->duration;
        $this->close = isset($configs['close']) ? $configs['close'] : $this->close;
        $this->gravity = isset($configs['gravity']) ? $configs['gravity'] : $this->gravity;
        $this->position = isset($configs['position']) ? $configs['position'] : $this->position;
        $this->color = isset($configs['color']) ? $configs['color'] : $this->color;
    }

    private function options(){
        return [
            'text' => $this->text,
            'duration' => $this->duration,
            'close' => $this->close,
            'gravity' => $this->gravity,
            'position' => $this->position,
            'color' => $this->color,
        ];
    }

    public function Success()
    {
        if (!$this->text) {
            $this->text = "Success";
        }
        if (!$this->color) {
            $this->color = "#198754";
        }
        $this->dispatchBrowserEvent('toastify', $this->options());
    }

    public function Error()
    {
        if (!$this->text) {
            $this->text = "Error";
        }
        if (!$this->color) {
            $this->color = "#f3616d";
        }
        $this->dispatchBrowserEvent('toastify', $this->options());
    }

    public function Info()
    {
        if (!$this->text) {
            $this->text = "Info";
        }
        if (!$this->color) {
            $this->color = "#56b6f7";
        }

        $this->dispatchBrowserEvent('toastify', $this->options());
    }

    public function Warning()
    {
        if (!$this->text) {
            $this->text = "Warning";
        }
        if (!$this->color) {
            $this->color = "#eaca4a";
        }

        $this->dispatchBrowserEvent('toastify', $this->options());
    }
}
