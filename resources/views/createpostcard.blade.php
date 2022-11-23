<html>
    <form method="POST" action="{{ url('create-postcard') }}" enctype="multipart/form-data">
        @csrf
        <p>Название праздника<input type="text" name="holiday"></p>
        <select name="type_holiday">
            <option value="Свадьба">Свадьба</option>
            <option value="День рождение">День рождение</option>
            <option value="Корпоратив">Корпоратив</option>
        </select>
        <p>Загрузить картинку<input type="file" name="img"></p>
        <p>Текст на открытке<input type="text" name="text"></p>
        <p>Описание открытки<input type="text" name="description"><p>
        <p>Получатель<input type="text" name="address"></p>
        <button>Отправить</button>
    </form>
    <a href='/home'>Вернуться</a>
</html>