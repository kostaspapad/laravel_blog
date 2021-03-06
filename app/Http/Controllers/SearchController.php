<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Elasticsearch\ClientBuilder;
    
class SearchController extends Controller
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
        //$this->middleware('auth', ['except' => ['index', 'show']]);
        // /*
        // * Adds create permission middleware to the routes create and store only. 
        // * If the user tries to access either create or store routes, the middleware
        // * will check to see if the user has the required authorization. If the user
        // * does not have access, a 403 exception will be thrown.
        // */
        // $this->middleware('permission:create', ['only' => ['create', 'store']]);
        
        // /*
        // * Adds edit permission middleware to routes edit and update. 
        // * On edit and updaly users withte permissions will be able to
        // * access these routes.
        // */
        // $this->middleware('permission:edit', ['only' => ['edit', 'update']]); 
        
        // /*
        // * Add the delete permission middleware to routes show and delete.
        // * Only users with show and delete permissions will be able to access
        // * these routes.
        // */
        // $this->middleware('permission:delete', ['only' => ['show', 'delete']]);
    }

    public function searchPosts(Request $request){

        // Get user input
        $searchTerm = $request->input('searchTerm');
        
        if($searchTerm != ""){
            $params = [
                'index' => 'blog',
                'type' => 'post',
                'body' => [
                    'query' => [
                        'query_string' => [
                            'query' => $searchTerm,
                            "fields"=> ["post_title", "post_body", "post_category"]
                        ]
                    ]
                ]
            ];
            
            $client = ClientBuilder::create()->build();
            $response = $client->search($params);
            
            // If client return data return data else return 0
            if($response['hits']['total'] !== 0){

                // Get hits
                $hits = count($response['hits']['hits']);

                // Init i, result
                $result = null;
                $i = 0;
                
                // Loop for every hit and insert _id data to $posts
                while ($i < $hits) {
                    $posts[$i] = Post::find($response['hits']['hits'][$i]['_id']);
                    $i++;
                }
                
                // Render and return view as response to ajax
                return view('layouts.partials.search.blog_post_response')->with('posts', $posts);

            } else {
                return 0;
            }
        // User send empty search request, return all posts
        } else {
            $posts = Post::all();
            return view('layouts.partials.search.blog_post_response')->with('posts', $posts);
        }
    }

    public function autoComplete(Request $request){
        //dd($request);

       // Get user input
       $searchTerm = $request->input('q');
       
       // Use bool query to match, also the should match keyword is increasing
       // the score of the match if is successfull
       $params = [
           'index' => 'blog',
           'type' => 'post',
           'body' => [
               'query' => [
                   'bool' => [
                       'must' => [
                            'match' => [
                                'post_title.autocomplete' => $searchTerm
                            ]
                       ],
                       'should' => [
                            'match' => [
                                'post_title' => $searchTerm
                            ]
                       ]
                   ]
                ],
                '_source' => [
                    'post_title'
                ]
            ]
        ];
       
        $client = ClientBuilder::create()->build();
        $response = $client->search($params);
        // If client return data return data else return 0
        if($response['hits']['total'] !== 0){

            // Get hits
            $hits = count($response['hits']['hits']);

            // Init i, result
            $result = null;
            $i = 0;
        
            // Loop for every hit and insert _source data to $autocomplete_response
            while ($i < $hits) {
                $autocomplete_response[$i] = $response['hits']['hits'][$i]['_source']['post_title'];
                $i++;
            }
            // dd($autocomplete_response);
            return $autocomplete_response;
        } else {
            return 0;
        }
    }

    public function searchMessages(Request $request){
        // Get user input
        $searchTerm = $request->input('searchTerm');
         
        $params = [
            'index' => 'blog',
            'type' => 'message',
            'body' => [
                'query' => [
                    'query_string' => [
                        'query' => '*'.$searchTerm .'*',
                        "fields"=> ["message_title", "message_body"]
                    ]
                ]
            ]
        ];
        
        $client = ClientBuilder::create()->build();
        $response = $client->search($params);
        
        // dd($response);
        
        // If client return data return data else return 0
        if($response['hits']['total'] !== 0){

            // Get hits
            $hits = count($response['hits']['hits']);

            // Init i, result
            $result = null;
            $i = 0;
            
            // Loop for every hit and insert _source data to $result
            while ($i < $hits) {
                $result[$i] = $response['hits']['hits'][$i]['_source'];
                $i++;
            }
            // dd($result);
            // Render and return view as response to ajax
            return view('layouts.partials.search.message_response')->with('result', $result);

        } else {
            return 0;
        }
    }
}



// Helpers
//
// 
// {
// "query": {
//     "bool": {
//     "must": {
//         "match": {
//         "post_title.autocomplete": "ΑΛΕΞΗΣ ΤΣΙΠ"
//         }
//     },
//     "should": {
//         "match": {
//         "post_title": "ΑΛΕΞΗΣ ΤΣΙΠ"
//         }
//     }
//     }
// },
// "_source": [
//     "post_title"
// ]
// }