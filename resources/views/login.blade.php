<!DOCTYPE html>
<html lang="tr">

    <head>
        <meta charset="UTF-8">
        <title>Giris</title>
        <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
        <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'>
        <link rel="stylesheet" href="{{asset('/css/login.css')}}">
        <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js'></script>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
    </head>

    <body>
        <div class="container">
            <form class="form-signin" action="{{route('session-start')}}" method="post">
                {{ csrf_field() }}
                <label for="email" class="sr-only">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="E-posta" required>
                <label for="password" class="sr-only">Şifre</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Şifre" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Giriş</button>
            </form>
        </div>
    </body>

</html>

