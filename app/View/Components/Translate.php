<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Stichoza\GoogleTranslate\GoogleTranslate;

class Translate extends Component
{
    public $text;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($text)
    {
        $this->text = $text;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $lang = $lang =app()->getLocale();
        $changed_text = GoogleTranslate::trans($this->text, $lang, 'en');
        return view('cart.components.translate',compact('changed_text'));
    }
}
