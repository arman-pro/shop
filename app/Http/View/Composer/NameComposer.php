<?php

namespace App\Http\View\Composer;

use Illuminate\View\View;

class NameComposer
{
    public function compose(View $view)
    {
        $view->with('name', 'Mohammad Arman Khan');
    }
}
