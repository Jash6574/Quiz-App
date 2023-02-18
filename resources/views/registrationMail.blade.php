<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $data['title'] }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <table>
        <tr>
            <td>Name: </td>
            <td>{{$data['name']}}</td>
        </tr>
        <tr>
            <td>Email: </td>
            <td>{{$data['email']}}</td>
        </tr>
        <tr>
            <td>Password: </td>
            <td>{{$data['password']}}</td>
        </tr>
    </table>
    <p>
        <a href="{{ $data['url'] }}">Click here to login into your Account.</a>
    </p>
    <p>Thank You!</p>
</body>

</html>
