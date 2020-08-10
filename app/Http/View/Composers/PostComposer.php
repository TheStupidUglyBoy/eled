<?php

namespace App\Http\View\Composers;
use Illuminate\View\View;
use App\Post;
use CyrildeWit\EloquentViewable\InteractsWithViews; // for post view counter
use CyrildeWit\EloquentViewable\Contracts\Viewable; // for post view counter

class PostComposer
{
    public $post_limit = 3 ; // decide how many post we shall return 
    public $latest_posts ;
    public $most_view_posts;
    public $active_posts_count;
    public $post_most_view_count;

    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->latest_posts       = Post::active()->latest()->take($this->post_limit)->get();
        $this->most_view_posts    = Post::active()->orderByUniqueViews()->take($this->post_limit)->get();
        $this->active_posts_count = Post::active()->count();

        $post = Post::orderByViews()->get()->first();
        if( !is_null($post) ){

            $this->post_most_view_count = views($post)->unique()->count() ;
        }

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('latest_posts', $this->latest_posts  );
        $view->with('most_view_posts', $this->most_view_posts  );
        $view->with('active_posts_count', $this->active_posts_count  );

        $view->with('post_most_view_count', $this->post_most_view_count  );

    }
}