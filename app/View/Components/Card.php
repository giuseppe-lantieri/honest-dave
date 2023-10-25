<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Card extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $route,
        public string $src,
        public string $alt,
        public string $name,
        public string $delete,
        public string $favorite,
        public string $sfavorite,
        public string $stats,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card');
    }
}
