<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;

class VotesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   
        /*
         * Blocks guests from using the controllers views, except the index and show view
         */
        $this->middleware('auth');

        /*
         * Adds create permission middleware to the routes create and store only. 
         * If the user tries to access either create or store routes, the middleware
         * will check to see if the user has the required authorization. If the user
         * does not have access, a 403 exception will be thrown.
         */
        // $this->middleware('permission:create', ['only' => ['create', 'store']]);
         
        //  /*
        //   * Adds edit permission middleware to routes edit and update. 
        //   * On edit and updaly users withte permissions will be able to
        //   * access these routes.
        //   */
        // $this->middleware('permission:edit', ['only' => ['edit', 'update']]); 
         
        //  /*
        //   * Add the delete permission middleware to routes show and delete.
        //   * Only users with show and delete permissions will be able to access
        //   * these routes.
        //   */
        // $this->middleware('permission:delete', ['only' => ['show', 'delete']]);
    }
    
    public function store(Request $request){

        // Get user
        $userID = $request->input('userID');
        $user = User::find($userID);

        // Check if user has a role else return 'not_authorized'
        if($user->hasRole(['owner', 'admin', 'user'])){
            
            // Get post id from request
            $postID = $request->input('postID');
            $post = Post::find($postID);

            // Get task (upvote/downvote)
            $task = $request->input('task');

            // If user has upvoted and task is upvote return 0(did nothing)
            // else if user has upvoted and wants to downvote then cancel
            // vote. Else rerurn -1 (error)
            if($user->hasUpVoted($post) && $task == 'upvote'){
                return 'hasupvoted';
            } else if($user->hasUpVoted($post) == true && $task == 'downvote'){
                $user->cancelVote($post);
                return $this->calculateVotes($post);
            }

            // If user has downvoted and task is downvote return 0(did nothing)
            // else if user has downvoted and wants to upvote then cancel
            // vote. Else rerurn -1 (error)
            if($user->hasDownVoted($post) && $task == 'downvote'){
                return 'hasdownvoted';
            } else if($user->hasDownVoted($post) == true && $task == 'upvote'){
                $user->cancelVote($post);
                return $this->calculateVotes($post);
            }
            
            // If user has not upvoted or downvoted and wants to upvote. Run upVote()
            // Else if user has not upvoted or downvoted and wants to downvote. Run downVote()
            // Else return -1 (error)
            if(!$user->hasUpVoted($post) && !$user->hasDownVoted($post) && $task == 'upvote'){
                $user->upVote($post);
                return $this->calculateVotes($post);            
            } else if(!$user->hasUpVoted($post) && !$user->hasDownVoted($post) && $task == 'downvote'){
                $user->downVote($post);
                return $this->calculateVotes($post);
            } else {
                return 'error';
            }

        } else {
            return 'not_authorized';
        }
    }

    /*
     * Calculate total votes
     * 
     * @param App\Post
     * 
     * @return integer
     */
    public function calculateVotes($post){
        $total = $post->countUpVoters() - $post->countDownVoters();
        return $total;
    }
}
