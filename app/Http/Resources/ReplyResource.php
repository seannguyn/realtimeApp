<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // userLiked = ;
        return [
            'id' => $this->id,
            'reply' => $this->body,
            'user' => $this->user->name,
            'user_id' => $this->user->id,
            'question_slug' => $this->question->slug,
            'like_count' => $this->like->count(),
            // 'liked' => !! $this->like->where('user_id',auth()->user()->id)->count(),
            'liked' => auth()->user() === null ? false : !! $this->like->where('user_id',auth()->user()->id)->count(),
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
