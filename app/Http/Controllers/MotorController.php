<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Motor;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
class MotorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $motors = Motor::all();        
        $users = User::all();        
        return view('pages.Gallery-List', ['motors' => $motors, 'users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
        public function create()
        {
            //authorizing just the admin and user
            if(isset(Auth::user()->level) && ((Auth::user()->level=="user") || (Auth::user()->level=="administrator"))){
                return view('pages.AddOffer');
            }
            return redirect('login');
        }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        ///authorizing the user and the admin
        if(isset(Auth::user()->level)){
        
            if(((Auth::user()->level=="user") || (Auth::user()->level=="administrator"))){
                
                $validation = $request->validate([
                    'constructionDate' => 'required',
                    'model' => 'required',
                    'color' => 'required',
                    'price' => 'required',
                    'brand' => 'required',
                    'description' => 'required|max:100',
                    'picture' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                    'thumbnail' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                    ]);
                
                $transid = Carbon::now()->timestamp;
                $pic_ext=$request->file('picture')->getClientOriginalExtension();
                //saving the picture with timestamp
                $path_pic = $request->file('picture')->storeAs('picture', $transid.".".$pic_ext,"public");
                $thumb_ext=$request->file('thumbnail')->getClientOriginalExtension();
                $path_thu = $request->file('thumbnail')->storeAs('thumbnail', $transid.".".$thumb_ext,"public");
                $motor = new Motor;
                $motor->constructionDate=$request->constructionDate;
                $motor->model = $request->model;
                $motor->color = $request->color;
                $motor->price = $request->price;
                $motor->brand=$request->brand;
                $motor->user_id = Auth::user()->id;
                $motor->description=$request->description;
                $motor->picture = "/storage/".$path_pic;
                $motor->thumbnail = "/storage/".$path_thu;
                var_dump($motor->picture);
                var_dump($motor->thumbnail);
                $motor->save();
                return redirect("/motors");
            }
        }
        //return redirect('login'); 
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {        
        $motor=Motor::find($id);        
        $user=User::find($motor->user_id); // TODO Workaround because cannot implement working user() in newsPost        
        return view("pages.Gallery-Detail",['motor' => $motor, 'user' => $user]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(isset(Auth::user()->level)){
            $motor=Motor::find($id);
            if(((Auth::user()->level=="user" && Auth::user()->id==$motor->user_id)) || (Auth::user()->level=="administrator")){
                return view("pages.Edit-motor",['motor' => $motor]);   
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
    public function update(Request $request, $id)
    {   
    if(isset(Auth::user()->level))
        {$motor = Motor::find($id);
        if(((Auth::user()->level=="user" && Auth::user()->id==$motor->user_id)) || (Auth::user()->level=="administrator")){
                $validation = $request->validate([
                    'price' => 'required',
                    'constructionDate' => 'required',
                    'model' => 'required',
                    'color' => 'required',
                    'brand' => 'required',
                    'description' => 'required|max:1000',
                    'picture' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                    'thumbnail' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                ]);
                //if no picture is provided the old one is considered
                //the picture is rename with the name of the previusone. In this way the storage of picture is limited to teh picture used.
                if(isset($request->picture)){
                    
                    $name_file=basename($motor->picture);
                    $path_pic = $request->file('picture')->storeAs('picture',$name_file,"public");
                    $motor->picture = "/storage/".$path_pic;
                }
                if(isset($request->thumbnail)){
                    $name_file=basename($motor->thumbnail);
                    $path_thu= $request->file('thumbnail')->storeAs('thumbnail',$name_file,"public");
                    $motor->thumbnail = "/storage/".$path_thu;
                }
                $motor->constructionDate=$request->constructionDate;
                $motor->brand=$request->brand;
                $motor->model=$request->model;
                $motor->color=$request->color;
                $motor->price = $request->price;
                $motor->description = $request->description;
                $motor->save();
                return redirect("/motors/{$id}");
            }else{
                return "User does not have the correct authorization to delete this post.";
            }
        }
    
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return "this is destroy";
        if(isset(Auth::user()->level)){
            $motor=Motor::find($id);
            if((Auth::user()->level=="user" && (Auth::user()->id==$motor->user->id)) || (Auth::user()->level=="administrator")){
                return $motor = Motor::destroy($id); // return something to get control back to AJAX.
                // Problem: the below redirect seems to transport the method "delete" from the AJAX over to the redirection route below which only works with GET
                //return redirect("/motors"); 
                //return view("pages.Gallery-List");  // not working because the view needs data by the controller
                //return redirect()->route('motors'); // 'route not defined', probably because still using method 'delete'
                // $method = 'GET'; // it is still using method 'delete';
                //return redirect()->action('MotorController@index'); // still using delete method
               // => we redirect by AJAX in the frontend and not here!
    
            }
            else{
                return "User does not have the correct authorization to delete this post.";
            }
        }
        
    }
}
