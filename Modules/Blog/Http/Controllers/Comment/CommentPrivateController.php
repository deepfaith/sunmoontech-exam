<?php

namespace Modules\Blog\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Blog\Entities\Comment;
use Modules\Blog\Http\Traits\CommentTrait;


class CommentPrivateController extends Controller
{

    use CommentTrait;

    /**
     * Get the loggedin user comments
     * @return \Illuminate\Http\JsonResponse
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
     * creates a new comment
     * @param integer $post_id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|mixed|string
     */
    public function store($post_id,Request $request)
    {

        //check if the post belongs to user
        $user = auth()->user();
        $post = $this->checkIfUserPost($post_id);
        if( $post instanceof JsonResponse )
            return $post;

        //validates parameters
        $request->request->add(['post_id'=>$post_id]);
        $isvalid = $this->toValidate($request->all(),[
            'comment' => 'required',
            'post_id' => 'required|integer|exists:posts,id',
        ]);
        if( $isvalid instanceof JsonResponse )
            return $isvalid;

        //instantite comment
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->user_id = $user->id;

        //create a new comment
        $saved_comment = $post->comments()->save($comment);
        if ( $saved_comment ) {
            return $this->sendCustomResponse(200,
                [
                    'message' => __('blog::blog.added_success'),
                    'data' => $saved_comment
                ]
            );
        }else {
            return $this->sendNotAddedResponse(__('blog::comment.not_added_comment'));
        }
    }

    /**
     * updates the comment by id
     * @param Request $request
     * @param integer $post_id
     * @param integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $post_id, $id)
    {
        //check if the post belongs to user
        $user = auth()->user();
        $post = $this->checkIfUserPost($post_id);
        if( $post instanceof JsonResponse )
            return $post;

        //validation
        $request->request->add(['post_id'=>$post_id]);
        $request->request->add(['id' => $id]);
        $isvalid = $this->toValidate(
            $request->all(),
            [
                'id' => 'required|exists:comments',
                'post_id' => 'required|exists:posts,id',
                'comment' => 'required',
            ]
        );
        if( $isvalid instanceof JsonResponse )
            return $isvalid;

        //get the user and check if comment exists
        $comment = $user->comments()->find($id);
        if ( !$comment ) {
            return $this->sendNotFoundResponse(__('blog::comment.not_found_comment'));
        }

        //update the comment
        $updated = $comment->fill($request->all())->save();
        if ($updated)
            return $this->sendCustomResponse(200,
                [
                    'message' => __('blog::blog.saved_success'),
                    'data' => [
                        'id' => $request->id,
                        'title' => $request->comment,
                        'author' => $user->name,
                    ]
                ]
            );
        else
            return $this->sendNotAddedResponse(__('blog::comment.not_saved_comment'));
    }

    /**
     * Deletes the comment by id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($post_id,$id)
    {

        //check if the post belongs to user
        $user = auth()->user();
        $post = $this->checkIfUserPost($post_id);
        if( $post instanceof JsonResponse )
            return $post;

        //validation
        $isvalid = $this->toValidate(
            ['id'=>$id],
            ['id' => 'required|exists:comments']
        );
        if( $isvalid instanceof JsonResponse )
            return $isvalid;

        //get the user and check if comment exists
        $comment = $user->comments()->find($id);
        if (!$comment) {
            return $this->sendNotFoundResponse(__('blog::comment.not_found_comment'));
        }

        //deletes the comment
        if ($comment->delete()) {
            return $this->sendCustomResponse(200,
                [
                    'message' => __('blog::blog.deleted_success'),
                    'data' => $comment
                ]
            );
        } else {
            $this->sendNotAddedResponse(__('blog::blog.not_deleted_comment'));
        }
    }

}
