<a href='/postcard'>Создать открытку</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
 @csrf
 <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
 </a>
</form>

<p>Список полученных открыток</p>
@foreach ($list_postcard as $postcard)
    <img src="{{ $postcard->img }}" width="300" height="300">
    <p>{{ $postcard->holiday }}</p>
    <p>{{ $postcard->text }}</p>
    <p>{{ $postcard->description }}</p>
@endforeach
<br>
<p>Список отправленных открыток</p>
@foreach ($list_postcard_send as $postcard_send)
    <img src="{{ $postcard_send->img }}" width="300" height="300">
@endforeach