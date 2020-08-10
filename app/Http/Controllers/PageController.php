<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HomePage;
use Illuminate\Support\Str;

class PageController extends Controller
{
    

    public function editHome(){
    	$HomePage = HomePage::first();
    	return view('admin.page.edit-home',compact('HomePage'));
    }

    public function updateHome(HomePage $HomePage){

    	$validatedData = request()->validate([
            'heading' => 'required',
            'introduction_title' => 'required',
            'introduction' => 'required',
            'about' => 'required',
            'subscribe_new_letter' => 'required',
        ]);

        request()->validate([
            'heading_background' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20000',
            'about_backgroud' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20000',
        ]);

        $this->upload_image_for_home_page($HomePage);
        
        $HomePage->update($validatedData);
        return back();

    }

    public function ChangeHomeImage(HomePage $HomePage){
        if(request()->has('heading_background_image')){
            $validatedData = request()->validate([  'heading_background_image' => 'required', ]);
            if( $HomePage->getAttributes()['heading_background_image'] != 'hero.jpg'){
                unlink( public_path("img/". $HomePage->getAttributes()['heading_background_image'] ) );
            }
        }else{
            $validatedData = request()->validate([  'about_background_image' => 'required', ]);
            if( $HomePage->getAttributes()['about_background_image'] != 'divider-bg.jpg'){
                unlink( public_path("img/". $HomePage->getAttributes()['about_background_image'] ) );
            }
        }
        $HomePage->update($validatedData);
        return back();
    }

    private function upload_image_for_home_page($HomePage){

        if( request()->has('heading_background') ){
            $image          =  request()->file('heading_background');
            $file_name      =  Str::random(20).".".$image->getClientOriginalExtension() ;
            $image->move(public_path('img'), $file_name);
            $HomePage->update([ 'heading_background_image' => $file_name ]);
        }

        if( request()->has('about_backgroud') ){
            $image          =  request()->file('about_backgroud');
            $file_name      =  Str::random(20).".".$image->getClientOriginalExtension() ;
            $image->move(public_path('img'), $file_name);
            $HomePage->update([ 'about_background_image' => $file_name ]);
        }

    }

}
