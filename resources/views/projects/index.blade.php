
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<ul>
    @forelse($projects as $project)
        <li>{{$project->title}}</li>
        <li>{{$project->description}}</li>
    @empty
        <li class="text-danger">No Data Found</li>
    @endforelse
</ul>
</body>
</html>
