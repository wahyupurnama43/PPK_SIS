<?php

namespace App\View\Components;

use Closure;
use App\Models\Surat;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Notification extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        return view('components.notification');
    }
}
