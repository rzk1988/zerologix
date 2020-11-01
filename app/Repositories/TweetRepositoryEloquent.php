<?php

namespace App\Repositories;

use App\Entities\User;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TweetRepository;
use App\Entities\Tweet;


/**
 * Class TweetRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TweetRepositoryEloquent extends BaseRepository implements TweetRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Tweet::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Insert a tweet into database
     * @param Tweet $tweet
     * @return bool
     */
    public function insert(Tweet $tweet): bool
    {
        try {
            $tweet->save();
            return true;
        } catch (\Exception $e){
            print_r($e->getMessage());
        }
        return false;
    }

    /**
     * @param array $attributes
     * @param User $user
     * @return Tweet
     */
    public function createTweet(array $attributes, User $user): Tweet
    {
        $new = new Tweet($attributes);
        $new->user()->associate($user);
        return $new;
    }
}
