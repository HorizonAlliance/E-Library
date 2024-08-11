<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF VIewWer</title>

</head>
<body style="margin: 0; padding: 0;" >
    <iframe src="{{ asset('storage/' . $book->file) }}#toolbar=0&control=0" width="100%" height="800px" frameborder="0"></iframe>
</body>
</html>
