<?php

namespace App\Http\View\Composers;
use Illuminate\View\View;
use App\Category;

class CategoryComposer
{
    public $categories ;
    public $all_categories ;

    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {
        
        $this->categories  = Category::all()->pluck('name','id');
        $this->all_categories  = Category::all();
        
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('categories', $this->categories  );
        $view->with('all_categories', $this->all_categories  );

    }
}