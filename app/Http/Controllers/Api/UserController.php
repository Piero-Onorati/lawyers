<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Specialization;
use App\Review;
use App\Sponsor;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $specs = request('specialization');

        $perNumber =request('numberOfReviews');

        $perVote =request('avgVoteReviews');

        if(!$specs){
            $users = User::with(['specializations','reviews'])->paginate(9);
        } else {
            // $users = User::with(['specializations'])->where('id', $specs )->paginate(9);
            if($perNumber){
           
                $users = User::with(['specializations','reviews'])
                    ->join('specialization_user', 'users.id', '=', 'specialization_user.user_id')
                    ->join('reviews', 'reviews.user_id', '=', 'users.id','left outer')
                    ->selectRaw('users.*, count(reviews.id) as reviews_count')
                    ->where('specialization_id',$specs)
                    ->groupBy('users.id')
                    ->orderBy('reviews_count','desc')
                    ->paginate(9);
  
            }elseif ($perVote) {
               
                $users = User::with(['specializations','reviews'])
                    ->join('specialization_user', 'users.id', '=', 'specialization_user.user_id')
                    ->join('reviews', 'reviews.user_id', '=', 'users.id','left outer')
                    ->selectRaw('users.*, avg(reviews.vote) as reviews_avg')
                    ->where('specialization_id',$specs)
                    ->groupBy('users.id')
                    ->orderBy('reviews_avg','desc')
                    ->paginate(9);
               
            } else {
                $users = User::with(['specializations','reviews'])->join('specialization_user', 'users.id', '=', 'specialization_user.user_id')->where('specialization_id',$specs)->select('users.*')->paginate(9);
            }
        
            
        }

        $sponsorUser = User::with(['specializations','reviews','sponsors'])->get();

        foreach($users as $user){
            if($user->photo){
                $user->photo = url('storage/' . $user->photo); 
            }
        }

        foreach($users as $user){
            if($user->cv){
                $user->cv = url('storage/' . $user->cv); 
            }
        }
        
        return response()->json([
            'success' => true,
            'results' => $users,
            'results1' => $sponsorUser
        ]);
    
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $user = User::where('slug', $slug)->with(['specializations','reviews'])->first();
        if($user){
            if($user->photo){
                $user->photo = url('storage/' .$user->photo);
            }

            if($user->cv){
                $user->cv = url('storage/' .$user->cv);
            }

            return response()->json([
                'success' => true,
                'results' => $user
            ]);
        }
    }

    // // public function searchData($data){
    // //     dd($data);

        
    //     // $user_query= User::with(['specializations']);
    //     // if ($data) {
    //     //     $user_query->whereHas('specializations', function($query) use($data){
    //     //         $query->where('name',$data );
    //     //     });
    //     // }
        
    //     // $user= $user_query->get();
    //     // return response()->json([
    //     //     'success' => true,
    //     //     'results' => $user
    //     // ]);
    // // }

   
}
