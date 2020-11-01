<?php


namespace App\Services;

use App\Entities\Tweet;
use App\Repositories\UserRepository;
use GuzzleHttp\Exception\GuzzleException;
use Takeoo\Service\Traits\Service;
use App\Repositories\TweetRepository;
use GuzzleHttp\Client;

class TweetService
{
    use Service;

    /**
     * @var TweetRepository
     */
    protected $repository;

    /**
     * @var UserRepository
     */
    protected $userRepo;

    /**
     * @var Client
     */
    protected $client;

    public function __construct(TweetRepository $repository, UserRepository $userRepo)
    {
        $this->repository = $repository;
        $this->userRepo = $userRepo;
        $this->client = new Client();
    }

    /**
     * Post a tweet by calling Twitter Apis
     *
     * @param string $status
     * @param integer $user_id
     * @return bool
     */
    public function post($status, $user_id): bool
    {
        try {
            $headers = $this->generatePostHeaders('POST', 'https://api.twitter.com/1.1/statuses/update.json',$status);
            $res= $this->client->post('https://api.twitter.com/1.1/statuses/update.json', [
                'headers' => $headers,
                'query' => ['status' => $status]
            ]);
            if ($res->getStatusCode() === 200) {
                $user = $this->userRepo->find($user_id);
                $tweet = $this->repository->createTweet(['content' => $status], $user);
                $this->repository->insert($tweet);
                return true;
            }
        } catch (GuzzleException $e){
            echo $e->getMessage(); //log in production instead of print the error message
        }
        return false;
    }

    /**
     * Get timeline of authenticating user
     *
     */
    public function timeline()
    {
    }

    private function generatePostHeaders($protocol, $url, $status): array
    {
        $oauth_consumer_key = env('TWITTER_API_KEY');
        $oauth_token = env('TWITTER_ACCESS_TOKEN');
        $timestamp = time();
        $oauth_nonce = rawurlencode(base64_encode($this->generateRandomString()));
        $base = strtoupper($protocol).'&'.rawurlencode($url).'&'
            . rawurlencode('oauth_consumer_key=' . rawurlencode($oauth_consumer_key)
                . '&oauth_nonce=' . $oauth_nonce
                . '&oauth_signature_method=' . rawurlencode('HMAC-SHA1')
                . '&oauth_timestamp=' . rawurlencode($timestamp)
                . '&oauth_token=' . rawurlencode($oauth_token)
                . '&oauth_version=' . rawurlencode('1.0')
                . '&status=' . rawurlencode($status));
        $signing_key = rawurlencode(env('TWITTER_API_SECRET_KEY')).'&'.rawurlencode(env('TWITTER_TOKEN_SECRET'));
        $signature = rawurlencode(base64_encode(hash_hmac('sha1', $base, $signing_key, true)));
        return [
            'Authorization' => "OAuth 
            oauth_consumer_key=\"$oauth_consumer_key\", 
            oauth_nonce=\"$oauth_nonce\", 
            oauth_signature=\"$signature\", 
            oauth_signature_method=\"HMAC-SHA1\", 
            oauth_timestamp=\"$timestamp\", 
            oauth_token=\"$oauth_token\", 
            oauth_version=\"1.0\"",
        ];
    }

    private function generateRandomString($length = 32): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}