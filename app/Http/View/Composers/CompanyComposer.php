<?php

namespace App\Http\View\Composers;
use Illuminate\View\View;
use App\Company;

class CompanyComposer
{
    public $companies_list ;

    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {
        
        $this->companies_list  = Company::all()->pluck('name','id');
        
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('companies_list', $this->companies_list  );


    }
}