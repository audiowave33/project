<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        
        <!-- Styles -->
        <link href="../css/app.css" rel="stylesheet">
        <link href="../css/menu.css" rel="stylesheet">
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>


    <body>
        <!-- Шапка сайта -->
        <div id="header">
            <p><img width="46" height="46" src="icon/user.png">{{ Auth::user()->name }}</p>
            <a href='/postcard'>Создать открытку</a>

            <a href='/postcardlayout'>Создать открытку c шаблоном</a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            <a  href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                               Выход 
            </a>
        </div>

        
        <br>
        
        
        
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

            
        <h2>Список полученных открыток</h2>
        @foreach ($list_postcard as $postcard)
        <div class="card mb-3" style="max-width: 640px;">
            <div class="row no-gutters">
                <div class="col-md-4">
                <a href="{{ $postcard->img }}" target="_blank"><img src="{{ $postcard->img }}" width="175" height="275"></a>
                </div>
                <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">Название: {{ $postcard->holiday }}</h5>
                    <p class="card-text">Тип мероприятия: {{ $postcard->type_holiday }}</p>
                    <p class="card-text">Описание: {{ $postcard->description }}</p>
                    
                </div>
                </div>
            </div>
        </div>
        @endforeach
        
        
        {{ $list_postcard->links("pagination::bootstrap-4") }}
        <br>
        <p>Список отправленных открыток</p>
        @foreach ($list_postcard_send as $postcard_send)
            <a href="{{$postcard_send->img }}" target="_blank"><img src="{{ $postcard_send->img }}" width="300" height="300"></a>
        @endforeach
        </div>
        </div>
</html>