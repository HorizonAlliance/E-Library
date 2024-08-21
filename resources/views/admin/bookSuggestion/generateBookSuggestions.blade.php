<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Generate Book Request</title>
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
            <h1>Suggest Books </h1>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>User</th>
                    <th>Description</th>
                    <th>Likes</th>
                    <th>Suggest date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suggest as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->author}}</td>
                    <td>{{$item->publisher}}</td>
                    <td>{{$item->user->name}}</td>
                    <td>{{$item->description}}</td>
                    <td>{{$item->suggestions_like_count}}</td>
                    <td>{{$item->created_at}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
