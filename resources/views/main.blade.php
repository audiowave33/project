<a href='/postcard'>Создать открытку</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
 @csrf
 <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
 </a>
</form>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<script>
    
    </script>


<div class="body-cabinet">
<div class="main-form">
    
<div class="alert alert-success" role="alert">
  Вам новая открытка!
</div>

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
</div>
</div>