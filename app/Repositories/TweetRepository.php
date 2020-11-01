<?php

namespace App\Repositories;

use App\Entities\Tweet;
use App\Entities\User;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface TweetRepository.
 *
 * @package namespace App\Repositories;
 */
interface TweetRepository extends RepositoryInterface
{
    /**
     * Insert a tweet into database
     * @param Tweet $tweet
     * @return bool
     */
    public function insert(Tweet $tweet): bool;

    /**
     * Create a tweet object
     *
     * @param array $attributes
     * @param User $user
     * @return Tweet
     */
    public function createTweet(array $attributes, User $user): Tweet;
}
