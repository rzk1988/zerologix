<?php


namespace App\Http\Controllers\Api;

use App\Repositories\TweetRepository;
use App\Services\TweetService;
use Illuminate\Foundation\Bus\DispatchesJobs;
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

    public function post()
    {
        return $this->tweetSrv->post();
    }
}