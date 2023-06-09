@extends('layouts/admin')

@section('content')
    <main class="container">
        <form action="{{route('admin.posts.update', $post)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="text-center mt-4">
                <h1>Modifica il post</h1>
            </div>

            <div class="mt-5">
                <div class="mb-4">
                    <label for="title">Titolo</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title', $post->title)}}">
                    @error('title')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="post_image">Immagine post</label>
                    <input type="file" id="post_image" name="post_image" class="form-control @error('post_image') is-invalid @enderror">
                    @error('post_image')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="type_id">Categoria</label>
                    <select name="type_id" id="type_id" class="form-select @error('type_id') is-invalid @enderror">
                        <option>Nessuna</option>
                        @foreach ($types as $type)
                            <option value="{{$type->id}}" {{$type->id == old('type_id', $post->type_id) ? 'selected' : ''}}>{{$type->name}}</option>
                         @endforeach
                    </select>
                    @error('type_id')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror   
                </div>

                <div class="mb-3 form-group">
                    <h6 class="mb-3">Tecnologie</h6>

                    @foreach ($technologies as $technology)
                    <span class="mx-2">
                        @if ($errors->any())
                            <input type="checkbox" id="tech-{{$technology->id}}" name="technologies[]" value="{{$technology->id}}" @checked(in_array($technology->id, old('technologies', [])))>
                        @else 
                            <input type="checkbox" id="tech-{{$technology->id}}" name="technologies[]" value="{{$technology->id}}" @checked($post->technologies->contains($technology))>
                        @endif
                        <label for="tech-{{$technology->id}}">{{$technology->name}}</label>
                    </span>
                    @endforeach
                </div>

                <div class="mb-4">
                    <label for="content">Contenuto</label>
                    <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" cols="30" rows="10">{{old('content', $post->content)}}</textarea>
                    @error('content')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="btn-container d-flex justify-content-end mb-4">
                <button type="submit" class="btn btn-primary text-light">Modifica</button>
            </div>
        </form>
    </main>
@endsection