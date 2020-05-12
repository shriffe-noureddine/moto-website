<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    private function insufficientPrivileges(){        
        $status = 'warning';
        $message = 'user privileges not sufficient, redirecting...';
        return app('App\Http\Controllers\UsersController')->errorControl($status, $message);
    }
    
    
    public function index()
    {   
        //accessible just form the admin
        if(isset(Auth::user()->level)){
            if(Auth::user()->level=="administrator"){
            $users=User::all();        
            return view("pages.Users-List",['users' => $users]);     
            }
        }
        // $status = 'warning';
        // $message = 'user privileges not sufficient, redirecting...';
        // return app('App\Http\Controllers\UsersController')->errorControl($status, $message);        
        return $this->insufficientPrivileges();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // going to the register page
        return redirect('/register');        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // not used, because it is registration process        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //accesible just for user and with the same id of the logged user and the admin
        if(isset(Auth::user()->level)){
            if((Auth::user()->level=="user" && Auth::user()->id==$id) || (Auth::user()->level=="administrator")){
                $user=User::find($id);                
                return view("pages.Users-Detail",['user' => $user]); 
            }
        }
        return $this->insufficientPrivileges();
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
            if((Auth::user()->level=="user" && Auth::user()->id==$id) || (Auth::user()->level=="administrator")){
            // providing the form to edit a user
                $user=User::find($id);                
                return view("pages.Users-Edit",['user' => $user]); 
            }
        }
        return $this->insufficientPrivileges();
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
                        
        $validation = $request->validate([
            'name' => 'required',
            //'phone' => 'required',
            'location' => 'required',
            'picture' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:10240',       
        ]);
        
        if(isset(Auth::user()->level)){
            
            //set the user to be user. 
            if(Auth::user()->level=="user"){
                if($request->level == "administrator"){
                    Log::warning('Possible security breach');
                    $request->level ="user";
                }                       
            }

            if((Auth::user()->level=="user" && Auth::user()->id==$id) || (Auth::user()->level=="administrator")){
                $user = \App\User::find($id);
                $user->name = $request->name;
                //$user->email = $request->email; => we instruct to delete and create a new user
                //$user->password = $request->password; => we instruct to use the password reset functionality
                $user->phone = $request->phone;
                $user->location = $request->location;
               
                if(isset($request->picture)){
                    $transid = Carbon::now()->timestamp;
                    $pic_ext=$request->file('picture')->getClientOriginalExtension();
                    //saving the picture with timestamp
                    $path_pic = $request->file('picture')->storeAs('users', $transid.".".$pic_ext,"public");
                    
                    //$user->picture = $request->picture; TODO picture upload
                    $user->picture = "/storage/".$path_pic;
                }
                //possibility to set the level from admin
                if(isset($request->level)){
                    $user->level = $request->level;   
                }
                $user->save();                
                return view("pages.Users-Detail",['user' => $user]);

            }
            return $this->insufficientPrivileges();      
        }        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {        
        return $user = \App\User::destroy($id);        
    }

    public function logout2register(){
        Auth::logout();
        return redirect('/register');
    }

    public function errorControl($status, $message){
        // user controller was chosen for this function because there is not authentication yet
        // so that it can be used for any user...

        return view('pages.errors',['status' => $status, 'message' => $message]);
    }


}
