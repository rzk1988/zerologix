<?php


namespace Tests\Feature;


use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TweetTest extends TestCase
{
    /**
     * Test case for post a tweet
     *
     * @return void
     */
    public function testPost()
    {
        $response = $this->post('/api/post', ['status' => 'hello', 'user_id' => 1]);
        $response->assertStatus(200);
    }

    /**
     * Test case for reply a tweet
     *
     * @return void
     */
    public function testReply()
    {
        $response = $this->post('/api/reply', ['status' => 'reply', 'tweet_id' => '1322780658154921984']);
        $response->assertStatus(200);
    }

    /**
     * Test case for post a tweet
     *
     * @return void
     */
    public function testRetweet()
    {
        $response = $this->post('/api/retweet', ['tweet_id' => '1322780658154921984']);
        $response->assertStatus(200);
    }

    /**
     * Test case for post a tweet
     *
     * @return void
     */
    public function testLike()
    {
        $response = $this->post('/api/like', ['tweet_id' => '1322780658154921984']);
        $response->assertStatus(200);
    }
}