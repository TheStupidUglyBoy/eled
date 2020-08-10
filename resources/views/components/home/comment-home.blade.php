                <div class="post-comments">
                  <header>
                    <h3 class="h6">Post Comments <i class="fas fa-comments"></i>
                      <span class="no-of-comments">{{ $post->get_post_active_comment_count($post) }}</span>
                    </h3>
                  </header>
                  @include('includes.notification_msg')

                  @if (  $comments->count() >=1    )
                  @foreach ($comments as $comment)

                  <div class="comment" id="comment-id-{{$comment->id}}">
                    <div class="comment-header d-flex justify-content-between">
                      <div class="user d-flex align-items-center">
                        <div class="image">
                          <img src="{{$comment->user->get_user_avatar($comment->user)}}" alt="..." class="img-fluid rounded-circle">
                        </div>
                        <div class="title">
                          <strong>{{$comment->user->username}}</strong>
                          <span class="date">{{$comment->created_at->diffForHumans()}}</span>
                          @if( $comment->user_id == Auth::id() )
                          <span class="edit-comment-form-link" data-edit-link-id="{{$comment->id}}">edit</span>
                          <span>
                            <form method="POST" action="{{route('post.comment.destroy',$comment)}}">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-link" type="submit" >delete</button>
                            </form>
                          </span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="comment-body">

                      <p class="display-comment-body"  id="display-comment-id-{{$comment->id}}" >
                        {{$comment->body}}
                      </p>
                      <form id="edit-comment-form-id-{{$comment->id}}" style="display: none" action="{{route('post.comment.update',$comment)}}" method="POST" class="edit-commenting-form">
                        @CSRF
                        @method('PATCH')
                        <div class="row">
                          <div class="form-group col-md-6">
                            <input name="body" id="body" class="form-control" required value="{{$comment->body}}"></input>
                          </div>
                          <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-secondary">Submit Comment</button>
                          </div>
                        </div>
                      </form>


                    </div>
    

                  </div>
                  @endforeach
                  @else
                  <h3 class="text-success">Be The First to comment</h3>
                  @endif

                </div>


                @if(Auth::check())
                <div class="add-comment">
                  
                  <header>
                    <h3 class="h6">Leave a reply</h3>
                  </header>
                  <form action="{{route('post.comment.store',$post)}}" method="POST" class="commenting-form">
                    @CSRF
                    <div class="row">
                      <div class="form-group col-md-12">
                        <textarea name="body" id="body" placeholder="Type your comment" class="form-control" required=""></textarea>
                      </div>
                      <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-secondary">Submit Comment</button>
                      </div>
                    </div>
                  </form>
                </div>
                @else
                <h5 class="text-success">Please Login To Comment</h5>
                @endif