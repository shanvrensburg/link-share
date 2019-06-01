@if (Auth::check())
    <div class="col-md-4">
        <h3>Contribute a Link</h3>

        <div class="card">
            <div class="card-body">
                <form action="/" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="channel">Channel:</label>

                        <select name="channel_id" class="form-control {{ $errors->has('channel_id') ? 'is-invalid' : '' }}">
                            <option value="" selected>Pick a channel</option>
                            @foreach ($channels as $channel)
                                <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>{{ $channel->title }}</option>
                            @endforeach
                        </select>

                        {!! $errors->first('channel_id', '<span class="invalid-feedback">:message</span>') !!}
                    </div>

                    <div class="form-group">
                        <label for="title">Title:</label>

                        <input type="text"
                            class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                            id="title"
                            name="title"
                            placeholder="What is the title of your article?"
                            value="{{ old('title') }}"
                            required>

                        {!! $errors->first('title', '<span class="invalid-feedback">:message</span>') !!}
                    </div>

                    <div class="form-group">
                        <label for="link">Link:</label>

                        <input type="text"
                            class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}"
                            id="link"
                            name="link"
                            placeholder="What is the URL?"
                            value="{{ old('link') }}"
                            required>

                        {!! $errors->first('link', '<span class="invalid-feedback">:message</span>') !!}
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary">Contribute link</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
