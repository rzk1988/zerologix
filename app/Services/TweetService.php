<?php


namespace App\Services;

use Takeoo\Service\Traits\Service;
use App\Repositories\TweetRepository;

class TweetService
{
    use Service;

    /**
     * @var TweetRepository
     */
    protected $repository;

    public function __construct(TweetRepository $repository)
    {
        $this->repository = $repository;
    }

    public function post()
    {
        return $this->repository->all();
    }

    public function timeline()
    {

    }
}