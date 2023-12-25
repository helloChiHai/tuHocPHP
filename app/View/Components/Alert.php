<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * Create a new component instance.
     */
    public $type;
    public $content;
    public $dataIcon;
    // đặt giá trị mặc định là success
    public function __construct($type = 'success', $content, $icon)
    {
        $this->type = $type;
        if (empty($content)) {
            $this->content = '';
        } else {
            $this->content = $content;
        }
        $this->dataIcon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert');
    }
}
