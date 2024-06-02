<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Inputautocomplete extends Component
{
    $url;
    $inputId;
    $suggestionId;
    $placeholder;

    public function __construct($url, $inputId='item-input', $suggestionId='suggestions', $placeholder='Найдите или создайте новый')
    {
        $this->url= $url;
        $this->inputId = $inputId;
        $this->suggestionId = $suggestionId;
        $this->placeholder = $placeholder;
    }

    public function render(): View
    {
        return view('components.input-autocomplete');
    }
}
