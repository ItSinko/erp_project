<?php

namespace App\AdminlteContainer;

use Illuminate\View\View;
use App\AdminlteContainer\AdminLte;

class AdminLteComposer
{
    /**
     * @var AdminLte
     */
    private $adminlte;

    public function __construct(AdminLte $adminlte)
    {
        $this->adminlte = $adminlte;
    }

    public function compose(View $view)
    {
        $view->with('adminlte', $this->adminlte);
    }
}
