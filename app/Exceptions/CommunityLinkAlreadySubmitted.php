<?php

namespace App\Exceptions;

class CommunityLinkAlreadySubmitted extends \Exception
{
    /**
     * Report or log an exception.
     *
     * @return void
     */
    public function report()
    {
        \Log::debug('Link already submitted');
    }
}
