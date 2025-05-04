<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        
    }

    /**
     * Add new post to the database.
     * 
     * @param array $postdata
     * 
     * @return Post $post
     */
    public function addPost(array $data){
        try{
            return Post::create($data);
        }catch(\Throwable $th){

        }
    }

    /**
     * Update the specified post in the database.
     * 
     * @param array $postdata
     * @param Post $post
     * 
     * @return Post $post
     */

    public function updatePost(array $data, Post $post){
        try{
            $post->update(array_filter($data));
            return $post;
        }catch(\Throwable $th){
            
        }
    }

    
}
