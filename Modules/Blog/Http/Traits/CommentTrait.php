<?php

namespace Modules\Blog\Http\Traits;

use Illuminate\Http\JsonResponse;
use Modules\Blog\Entities\Post;

trait CommentTrait
{
    /**
     * check if post belongs to user
     * @param int $post_id
     * @return string|void
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkIfUserPost(int $post_id)
    {
        //validate post
        $isvalid = $this->toValidate(
            ['id'=>$post_id],
            ['id' => 'required|integer|exists:posts']
        );
        //validation
        if( $isvalid instanceof JsonResponse )
            return $isvalid;

        //check if user has post and comments
        //else check if post exists
        $user = auth()->user();
        if( $user )
            $post = $user->posts()->find($post_id);
        else
            $post = Post::find($post_id);

        if( !$post ){
            return $this->sendNotFoundResponse(__('blog::post.not_found_post'));
        }else{
            return $post;
        }
    }
}
