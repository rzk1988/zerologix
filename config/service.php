<?php

return [
  "services" => [
    /*
     * Add your services here in format:
     * 'serviceAlias' = \My\Service\Class::class
     */
      'Tweet' => \App\Services\TweetService::class
  ],
  "non-singletons" => [
    /*
     * listed serviceAliases will not be declared as singletons
     */
  ]
];