<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommunityLinkVote extends model
{
    protected $table = 'community_links_votes';

    protected $fillable = ['user_id', 'community_link_id'];

    /**
     * @return bool|null
     * @throws \Exception
     */
    public function toggle()
    {
        if($this->exists) {
            return $this->delete();
        }

        return $this->save();
    }
}
