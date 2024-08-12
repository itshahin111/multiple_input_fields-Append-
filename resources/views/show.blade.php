<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Client Details</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container pt-5">
        <h2 class="text-center pb-3 text-primary">Client Details</h2>

        <div class="card">
            <div class="card-header">
                <h3>{{ $client->first_name }} {{ $client->last_name }}</h3>
            </div>
            <div class="card-body">
                <p><strong>Email:</strong> {{ $client->email }}</p>
                <p><strong>Phone:</strong> {{ $client->phone }}</p>
                <p><strong>Address:</strong> {{ $client->address }}</p>
            </div>
        </div>

        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger mt-3">Delete</button>
        </form>

        <a href="{{ route('clients.all') }}" class="btn btn-primary mt-3">Back</a>
    </div>
</body>

</html>
