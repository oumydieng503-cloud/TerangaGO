<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class VoyageurLayout extends Component
{
    public function __construct(public ?string $header = null) {}

    public function render(): View
    {
        return view('layouts.voyageur');
    }
}
