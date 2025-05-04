<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequests\StorePostRequest;
use App\Http\Requests\PostRequests\UpdatePostRequest;
use App\Models\Post;
use App\Services\PostService;

class PostController extends Controller
{
    /**
     * This property is used to handle various operations related to posts,
     * such as creating, updating.
     *
     * @var PostService
     */
    protected $postService;

    /**
     * Constructor for the PostController class.
     * 
     * Initializes the $postService property via dependency injection.
     * 
     * @param PostService $postService
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * This method return all posts from database.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->success(Post::all());
    }

    /**
     * Store a new post in the database using the PostService via the addPost method
     * passes the validated request data to addPost.
     * 
     * @param StorePostRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        return $this->success(
            $this->postService->addPost($request->validated()),'added successfuly',
            201
        );
    }
    /**
     * Get post from database.
     * 
     * @param Post $post
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return $this->success($post);
    }

    /**
     * Update a post in the database using the PostService via the updatePost method.
     * passes the validated request data to updatePost.
     * 
     * @param UpdatePostRequest $request
     * 
     * @param Post $post
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        return $this->success(
            $this->postService->updatePost($request->validated(),$post),'Updated successfuly'
        );
    }

    /**
     * Delete post from database.
     * 
     * @param Post $post
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return $this->success("Deleted successfuly",204);
    }
}
