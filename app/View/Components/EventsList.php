<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EventsList extends Component
{
    public $events;
    /**
     * Create a new component instance.
     */
    public function __construct($events = [])
    {
        //
        $this->events = $events;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        //
        return view('components.events-list');
    }
}
