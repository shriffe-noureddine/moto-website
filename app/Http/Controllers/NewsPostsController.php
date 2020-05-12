<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewsPost;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class NewsPostsController extends Controller
{

    //Controller to handle the post-news login. Part of the function should be accessible just form admin
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
    public function __construct()
    {
        $this->middleware(['auth','auth.admin'])->only('index');;
        // Alternativly
    }*/


    public function index()
    {
        $news = NewsPost::all();        
        return view('pages.News-List', ['news' => $news]);        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // get the add news page
    public function create()
    {
        //authorizing just the admin
        if(isset(Auth::user()->level) && (Auth::user()->level=="administrator"))
        {
            return view('pages.AddNews');
        }
        return redirect('/login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     //function to create a new post
    public function store(Request $request)
    {
        $validation = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        if(isset(Auth::user()->level)){
            if(Auth::user()->level=="administrator")
            {   
                $new = new NewsPost;
                $new->title = $request->title;
                $new->description = $request->description;
                $new->user_id=Auth::User()->id;
                $new->save();
                return redirect("/news");
            }
        }
        return redirect('/login');   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //function to diplay the news-post
    public function show($id)
    {
        $new=NewsPost::find($id);
         $user=\App\User::find($new->user_id); // TODO Workaround because cannot implement working user() in newsPost
         return view("pages.News-Detail",['new' => $new, 'user' => $user]);       
    }
    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     // function to lunch the edit news
    public function edit($id)
    {   
        if(isset(Auth::user()->level)){
            if(Auth::user()->level=="administrator")
                {
                    $new = NewsPost::find($id);
                    return view('pages.Edit-news', ['new' => $new]);
                }        
        }
        $status = 'warning';
        $message = 'user privileges not sufficient, redirecting...';
        return app('App\Http\Controllers\UsersController')->errorControl($status, $message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //function to update the post
    public function update(Request $request, $id)
    {
        
        $validation = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        if(isset(Auth::user()->level)){
         if((Auth::user()->level=="administrator"))
         {
            $new = NewsPost::find($id);
            $new->title = $request->title;
            $new->description = $request->description;
            $new->save();
            return redirect("/news/{$id}");
          }
        }
        return redirect('/login');      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Function to erase the post
    public function destroy($id)
    {
        if(isset(Auth::user()->level) && Auth::user()->level=="administrator"){
            return $new = NewsPost::destroy($id);
        } else {
            return "User does not have the correct authorization to delete this post.";
        }
    }
}