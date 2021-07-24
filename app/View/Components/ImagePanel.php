<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ImagePanel extends Component
{
    public $img,$price,$title, $pid;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($img,$title,$price,$pid)
    {
        $this->img = $img;
        $this->price = $price;
        $this->title = $title;
        $this->pid = $pid;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('cart.components.image-panel');
    }
}
