<?php

namespace Modules\Blog\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Blog\Entities\Post;


class PostPrivateController extends Controller
{
    /**
     * Get the loggedin user posts
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        //set the pagination if the parameters are supplied
        $limit = $request->get('limit');
        $offset =  $request->get('offset');
        if( $request->all() ) {
            $isvalid = $this->toValidate($request->all() ,[
                'limit' => 'required|integer',
                'offset' => 'required|integer'
            ]);
            //validation
            if( $isvalid instanceof JsonResponse )
                return $isvalid;
        }

        //check if user has posts
        $posts = $user->posts->skip($offset)->take($limit);
        if( !$posts || $posts->count()  === 0 ){
            return $this->sendNotFoundResponse(__('blog::post.not_found_post'));
        }
        return $this->sendCustomResponse(200,
            [
                'message' => __('blog::blog.success'),
                'data' => [
                    $posts
                ]
            ]
        );
    }

    /**
     * creates a new post
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|mixed|string
     */
    public function store(Request $request)
    {
        $isvalid = $this->toValidate($request->all() ,[
            'title' => 'required|unique:posts',
            'content' => 'required'
        ]);
        //validation
        if( $isvalid instanceof JsonResponse )
            return $isvalid;

        //instantite post
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;

        //get the use and create a new post
        $user = auth()->user();
        $saved_post = $user->posts()->save($post);
        if ( $saved_post ) {
            return $this->sendCustomResponse(200,
                [
                    'message' => __('blog::blog.added_success'),
                    'data' => $saved_post
                ]
            );
        }else {
            return $this->sendNotAddedResponse(__('blog::post.not_added_post'));
        }
    }

    /**
     * updates the post by id
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $request->request->add(['id' => $id]);
        $isvalid = $this->toValidate($request->all() ,[
            'id' => 'required|integer|exists:posts',
            'title' => 'required|unique:posts',
        ]);
        //validation
        if( $isvalid instanceof JsonResponse )
            return $isvalid;

        //get the user and check if post exists
        $user = auth()->user();
        $post = $user->posts()->find($id);
        if ( !$post ) {
            return $this->sendNotFoundResponse(__('blog::post.not_found_post'));
        }

        //update the post
        $updated = $post->fill($request->all())->save();
        if ($updated)
            return $this->sendCustomResponse(200,
                [
                    'message' => __('blog::blog.saved_success'),
                    'data' => [
                        'id' => $request->id,
                        'title' => $request->title,
                        'content' => $request->content,
                        'author' => $user->name,
                    ]
                ]
            );
        else
            return $this->sendNotAddedResponse(__('blog::post.not_saved_post'));
    }

    /**
     * Deletes the post by id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $isvalid = $this->toValidate(['id'=>$id] ,['id' => 'required|integer|exists:posts']);
        //validation
        if( $isvalid instanceof JsonResponse )
            return $isvalid;

        //get the user and check if post exists
        $user = auth()->user();
        $post = $user->posts()->find($id);
        if (!$post) {
            return $this->sendNotFoundResponse(__('blog::post.not_found_post'));
        }

        //deletes the post
        if ($post->delete()) {
            return $this->sendCustomResponse(200,
                [
                    'message' => __('blog::blog.deleted_success'),
                    'data' => $post
                ]
            );
        } else {
            $this->sendNotAddedResponse(__('blog::blog.not_deleted_post'));
        }
    }
}
