<?php

namespace App\Http\Controllers;

use App\Model\Like;
use App\Model\Reply;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LikeController extends Controller
{

    /**
   * Create a new AuthController instance.
   *
   * @return void
   */
    public function __construct()
    {
        $this->middleware('JWT');
    }

    public function likeIt(Reply $reply) {
        // use auth later
        // $reply->like()->create([
        //     'user_id' => auth()->id
        // ]);

        $reply->like()->create([
            'user_id' => '1'
        ]);

        return response([
            'liked' => 'True',
            'user_id' => '1'
        ], Response::HTTP_OK);
    }

    public function unlikeIt(Reply $reply) {
        // $reply->like()->where('user_id',auth->id())->first()->delete();
        $reply->like()->where('user_id','1')->first()->delete();

        return response([
            'liked' => 'False',
            'user_id' => '1'
        ], Response::HTTP_OK);
    }
}
