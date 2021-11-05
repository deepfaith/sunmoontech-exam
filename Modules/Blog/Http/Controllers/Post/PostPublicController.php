<?php

namespace Modules\Blog\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Blog\Entities\Post;


class PostPublicController extends Controller
{

    /**
     * Get all posts
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|mixed|string
     */
    public function index(Request $request)
    {
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

        //check if there are posts
        $posts = Post::all()->skip($offset)->take($limit);
        if( !$posts || $posts->count()  === 0  ){
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
     * Get post by Id
     * @param $id
     * @return \Illuminate\Http\JsonResponse|mixed|string
     */
    public function show($id)
    {
        $isvalid = $this->toValidate(['id'=>$id] ,['id' => 'required|integer|exists:posts']);
        //validation
        if( $isvalid instanceof JsonResponse )
            return $isvalid;

        //check if the post exists
        $post = Post::find($id);
        if (!$post) {
            return $this->sendNotFoundResponse(__('blog::post.not_found_post'));
        }
        return $this->sendCustomResponse(200,
            [
                'message' => __('blog::blog.success'),
                'data' => $post
            ]
        );
    }
}
