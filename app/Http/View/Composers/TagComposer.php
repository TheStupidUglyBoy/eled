<?php

namespace App\Http\View\Composers;
use Illuminate\View\View;
use App\Post;

class TagComposer
{
    public $tag_limit = 4 ; // decide how many tags we shall return 
    public $postPopularTags ;

    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->postPopularTags = Post::popularTags($this->tag_limit );
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('postPopularTags', $this->postPopularTags  );

    }
}