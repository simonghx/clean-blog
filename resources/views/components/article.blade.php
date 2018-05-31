<div class="post-preview">
        <a href="post.html">
          <h2 class="post-title">
            {{$post->titre}}
          </h2>
          <p class="post-subtitle">
            {{$post->contenu}}
          </p>
        </a>
        <p class="post-meta">Posted by
        <a href="#">{{$post->user->name}}</a>
          {{$post->created_at}}</p>
      </div>
      <hr>