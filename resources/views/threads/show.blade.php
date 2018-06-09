@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="#">
                        {{ $thread->creator->name }}
                    </a>
                    posted:
                    {{ $thread->title }}
                </div>

                <div class="card-body">
                    {{ $thread->body }}
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($thread->replies as $reply)
                @include('threads.reply')
            @endforeach
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            @auth
                <form
                    method="POST"
                    action="{{ route('threads.addReply', $thread->id) }}"
                >
                    {{ csrf_field() }}

                    <div class="form-group">
                        <textarea
                            name="body"
                            placeholder="Have something to say?"
                            rows="5"
                            class="form-control"
                        ></textarea>
                    </div>

                    <div class="form-group">
                        <button
                            type="submit"
                            class="btn btn-default"
                        >
                            Post
                        </button>
                    </div>
                </form>
            @else
                <p>Please <a href="{{ route('login') }}">sign in</a> to participate in this discussion.</p>
            @endauth
        </div>
    </div>
</div>
@endsection
