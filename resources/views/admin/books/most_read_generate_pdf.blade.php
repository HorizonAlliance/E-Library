<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Generate most read books</title>
    <style>
        .card{
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top:20px;

        }
        thead,th,td{
            border:1px solid black;
        }
        th,td{
            padding: 10px;
            text-align: left;
        }
        th{
            background-color: yellow;
        }

        .card-title{
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="card">
        <div class="card-title">
            <h1>Most Populary Books in {{$month}}</h1>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Total request</th>
                    <th>Release date</th>
                    <th>Upload date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$book->title}}</td>
                    <td>{{$book->author}}</td>
                    <td>{{$book->publisher}}</td>
                    <td>{{$book->permissions_count}}</td>
                    <td>{{$book->release_date}}</td>
                    <td>{{$book->created_at}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
