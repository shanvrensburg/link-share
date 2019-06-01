<?php

namespace App;

use App\Exceptions\CommunityLinkAlreadySubmitted;
use Illuminate\Database\Eloquent\Model;

class CommunityLink extends Model
{
    protected $fillable = [
        'channel_id',
        'title',
        'link'
    ];

    /**
     * @param User $user
     * @return CommunityLink
     */
    public static function from(User $user)
    {
        $link = new static;

        $link->user_id = $user->id;

        if ($user->isTrusted()) {
            $link->approve();
        }

        return $link;
    }

    /**
     * Contribute the given community link.
     *
     * @param array $attributes
     * @return bool
     * @throws CommunityLinkAlreadySubmitted
     */
    public function contribute($attributes)
    {
        if ($existing = $this->hasAlreadyBeenSubmitted($attributes['link'])) {
            $existing->touch();

            throw new CommunityLinkAlreadySubmitted('Link already submitted');
        }

        return $this->fill($attributes)->save();
    }

    /**
     * A community link has a creator.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Mark the community link as approved.
     *
     * @return $this
     */
    public function approve()
    {
        $this->approved = true;

        return $this;
    }

    /**
     * Scope query to particular channel
     *
     * @param Builder $builder
     * @param Channel $channel
     * @return mixed
     */
    public function scopeForChannel($builder, $channel)
    {
        if ($channel) {
            return $builder->where('channel_id', $channel->id);
        }

        return $builder;
    }

    /**
     * The community link is assigned a channel.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    /**
     * Determine if the link has already been submitted
     *
     * @param  string $link
     * @return mixed
     */
    protected function hasAlreadyBeenSubmitted($link)
    {
        return static::where('link', $link)->first();
    }

    public function votes()
    {
        return $this->hasMany(CommunityLinkVote::class, 'community_link_id');
    }
}
