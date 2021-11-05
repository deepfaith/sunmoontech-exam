<?php

namespace Modules\Blog\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Blog\Entities\Comment;
use Modules\Blog\Http\Traits\CommentTrait;


class CommentPublicController extends Controller
{

    use CommentTrait;

    /**
     * Get all comments
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|mixed|string
     */
    public function index($post_id, Request $request)
    {
        //check if the post belongs to user
        $user = auth()->user();
        $post = $this->checkIfUserPost($post_id);
        if( $post instanceof JsonResponse )
            return $post;

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

        //check if there are comments
        $comments = $post->comments->skip($offset)->take($limit);
        if( !$comments || $comments->count()  === 0 ){
            return $this->sendNotFoundResponse(__('blog::comment.not_found_comment'));
        }
        return $this->sendCustomResponse(200,
            [
                'message' => __('blog::blog.success'),
                'data' => [
                    $comments
                ]
            ]
        );
    }

    /**
     * Get comment by Id
     * @param $id
     * @return \Illuminate\Http\JsonResponse|mixed|string
     */
    public function show($post_id, $id)
    {
        //check if the post belongs to user
        $user = auth()->user();
        $post = $this->checkIfUserPost($post_id);
        if( $post instanceof JsonResponse )
            return $post;

        $isvalid = $this->toValidate(['id'=>$id], ['id' => 'required|integer|exists:comments']);
        //validation
        if( $isvalid instanceof JsonResponse )
            return $isvalid;


        //check if the comment exists
        $comment = comment::find($id);
        if (!$comment) {
            return $this->sendNotFoundResponse(__('blog::comment.not_found_comment'));
        }
        return $this->sendCustomResponse(200,
            [
                'message' => __('blog::blog.success'),
                'data' => $comment
            ]
        );
    }
}
