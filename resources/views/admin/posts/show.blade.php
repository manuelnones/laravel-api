@extends('layouts/admin')

@section('content')
<div class="container mt-5">
    <h1>{{$post->title}}</h1>

    @if ($post->post_image)
    <img src="{{asset('storage/' . $post->post_image)}}" alt="" class="w-25 my-4">
    @endif

    <div>Categoria: {{$post->type->name ?? 'nessuna'}}</div>

    <div class="d-flex mt-3 gap-2">
        @foreach ($post->technologies as $technology)
        <span class="badge rounded-pill" style="background-color: {{$technology->color}}">{{$technology->name}}</span>
        @endforeach
    </div>
    <hr>
</div>

<p>{{$post->content}}</p>

<div class="btn-container d-flex justify-content-center gap-4 m-5">
    <button class="btn btn-primary">
        <a href="{{route('admin.posts.edit', $post)}}" class="text-light text-decoration-none">Modifica il post</a>
    </button>
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Elimina il post
    </button>
</div>
  
  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminare il post?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Sei sicuro di voler eliminare il post "{{$post->title}}"?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>  
                <form action="{{route('admin.posts.destroy', $post)}}" method="POST">
                    @csrf
                    @method('DELETE')
                
                    <button type="submit" class="btn btn-danger">Elimina</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection