<?php


namespace App\Http\Controllers\Api;

use App\Repositories\TweetRepository;
use App\Services\TweetService;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Takeoo\Service\Traits\Service;

class TweetController extends BaseController
{
    use Service;
    /**
     * @var TweetService
     */
    protected $tweetSrv;

    public function __construct()
    {
        $this->tweetSrv = $this->getService('Tweet');
    }

    /**
     * Post a tweet
     *
     * @param  Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function post(Request $request)
    {
        $status = $request->input('status');
        $user_id = $request->input('user_id');
        if ($status && $user_id) {
            $post = $this->tweetSrv->post($status, $user_id);
            if ($post) return response('Success!', 200);
        }
        return response('Failed!', 400);
    }

    /**
     * Get current user's timeline
     *
     * @param  Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function timeline(Request $request)
    {
        $this->tweetSrv->timeline();
        return response('Failed!', 400);
    }

    /**
     * Retweet a tweet
     *
     * @param  Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function retweet(Request $request)
    {

        if ($tweet_id = $request->input('tweet_id')) {
            $retweet = $this->tweetSrv->retweet($tweet_id);
            if ($retweet) return response('Success!', 200);
        }
        return response('Failed!', 400);
    }
}