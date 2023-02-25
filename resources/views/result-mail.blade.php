<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <p>

            <b>Dear {{ $data['name'] }},</b>

            <p>Result of your Exam, <b>{{ $data['exam_name'] }}</b> has been declared.</p>
        </p>
        <a href="{{ $data['url'] }}">Click here to check your Result.</a>
        <br><br>
        <p>Thank You.</p>
    </body>
</html>
