<?php

namespace App\Http\Controllers;

use App\CommunityLink;
use App\Exceptions\CommunityLinkAlreadySubmitted;
use App\Channel;
use Auth;
use Illuminate\Http\Request;

class CommunityLinksController extends Controller
{
    public function index(Channel $channel = null)
    {
        $orderBy = request()->exists('popular') ? 'votes_count' : 'updated_at';

        $links = CommunityLink::with('channel', 'creator')
            ->withCount('votes')
            ->orderBy($orderBy, 'DESC')
            ->forChannel($channel)
            ->where('approved', 1)
            ->latest('updated_at')
            ->paginate(3);

        $channels = Channel::orderby('title', 'asc')->get();

        return view('community.index', compact('links', 'channels', 'channel'));
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'channel_id' => 'required|exists:channels,id',
                'title' => 'required',
                'link' => 'required|active_url'
            ]);

            CommunityLink::from(Auth::user())
                ->contribute($request->all());

            if (auth()->user()->isTrusted()) {
                flash()->success('Thanks for the contribution!');
            } else {
                flash('Thanks, this contribution will be approved shortly.');
            }
        } catch (CommunityLinkAlreadySubmitted $e) {
            flash()->info(
                'That link has already been submitted. We’ll instead bump the timestamp and bring that link back to the top. Thanks!'
            );
        }

        return back();
    }
}
