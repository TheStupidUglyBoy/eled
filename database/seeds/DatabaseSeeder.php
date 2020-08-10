<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    // public function run()
    // {
    //     $users = factory(App\User::class, 10)->create();
    // }


    public function run()
    {
        

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        //DB::table('posts')->truncate();

        factory(App\User::class,10)->create()->each(function($user){

            $user->post()->save( factory(App\Post::class)->make() );
            $user->tip()->save( factory(App\Tip::class)->make() );
            $user->news()->save( factory(App\News::class)->make() );
            //factory(App\News::class,40)->create();
        });

        factory(App\Category::class,4)->create();
        factory(App\Role::class,1)->create();
        
    }
}
