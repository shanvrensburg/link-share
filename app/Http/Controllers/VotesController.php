<?php

namespace App\Http\Controllers;

use App\CommunityLink;

class VotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param CommunityLink $link
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CommunityLink $link)
    {
        auth()->user()->toggleVoteFor($link);

        return back();
    }
}
