<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sport extends Component
{
    /**
     * The information titre.
     *
     * @var string
     */
    public $titre;

    /**
     * The information message.
     *
     * @var string
     */
    public $message;
    /**
     * Create a new component instance.
     */
    public function __construct($titre, $message)
    {
        $this->titre = $titre;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sport');
    }
}
