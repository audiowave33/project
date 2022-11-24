<a href='/postcard'>Создать открытку</a>
<br>
<a href='/postcardlayout'>Создать открытку c шаблоном</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
 @csrf
 
</form><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }} 
 </a>
 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 
<script>
    function check(){ fetch('/check')
        .then((response) => {
            // Проверяем успешность запроса и выкидываем ошибку
            if (!response.ok) {
                throw new Error('Error occurred!')
            }
            else{
                let div = document.createElement('div');
                div.innerHTML = "<div class='alert alert-success' role='alert'>Вам новая открытка!</div>";
                document.body.append(div);
                console.log(response.text())
            }

            
        })
        // Теперь попадём сюда, т.к выбросили ошибку
        .catch((err) => {
            console.log('Ошибка')
        })
    }
    setInterval(check,5000);


</script>


<div class="body-cabinet">
<div class="main-form">
    


<p>Список полученных открыток</p>
@foreach ($list_postcard as $postcard)
    <a href="{{ $postcard->img }}" target="_blank"><img src="{{ $postcard->img }}" width="300" height="300"></a>
    
    <h2>Название: {{ $postcard->holiday }}</h2>
    <h3>Описание: {{ $postcard->description }}</h3>
@endforeach
{{ $list_postcard->links("pagination::bootstrap-4") }}
<br>
<p>Список отправленных открыток</p>
@foreach ($list_postcard_send as $postcard_send)
    <a href="{{$postcard_send->img }}"><img src="{{ $postcard_send->img }}" width="300" height="300"></a>
@endforeach
</div>
</div>