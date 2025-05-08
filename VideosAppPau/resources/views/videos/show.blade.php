<x-videos-app-layout>

<h1>{{ $video->title }}</h1>
    <p>{{ $video->description }}</p>
    @php
        // Convertir una URL normal de YouTube a URL embebida
        $embedUrl = str_replace("watch?v=", "embed/", $video->url);
    @endphp
    <iframe
        src="{{ $embedUrl }}"
        width="560"
        height="315"
        frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen>
    </iframe>
    <p>Data: {{ $video->published_at }}</p>
    <p>Anterior: {{ $video->previous }}</p>
    <p>Seguent: {{ $video->next }}</p>
    <p>ID de la serie: {{ $video->series_id }}</p>
    @if (auth()->user() && auth()->user()->id == $video['user_id'])
        <div class="video-actions">
            <a href="{{ route('videos.edit', $video['id']) }}" class="btn btn-warning">Editar</a>
            <form action="{{ route('videos.destroy', $video['id']) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </div>
    @endif
    </x-videos-app-layout>

