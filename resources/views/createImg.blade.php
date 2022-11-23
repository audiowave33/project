<html>
    <form method="POST" action="{{ url('create') }}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="img">
        <button>Отправить</button>
    </form>
</html>