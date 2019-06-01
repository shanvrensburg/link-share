<ul class="list-group">
    @if(count($links))
        @foreach($links as $link)
            <li class="list-group-item">
                <form method="POST" action="/votes/{{ $link->id }}">
                    @csrf

                    <button class="btn {{ Auth::check() && Auth::user()->votedFor($link) ? 'btn-success' : 'btn-secondary' }}">
                        {{ $link->votes->count() }}
                    </button>
                </form>

                <a href="/{{ $link->channel->slug }}" class="badge badge-primary" style="background: {{ $link->channel->color }}">
                    {{ $link->channel->title }}
                </a>

                <a href="{{ $link->link }}" target="_blank">
                    {{ $link->title }}
                </a>

                <small>
                    Contributed by: {{ $link->creator->name }} {{ $link->updated_at->diffForHumans() }}
                </small>
            </li>
        @endforeach

        {{ $links->links() }}

    @else
        <li class="list-group-item">No contributions yet.</li>
    @endif
</ul>
