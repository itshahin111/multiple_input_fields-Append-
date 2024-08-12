<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add & Remove Clients</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
   
    <nav class="navbar navbar-light text-left bg-light">
        <a class="navbar-brand"  href="/">Home</a>
        <nav class="navbar navbar-light bg-light">
            <a class="btn btn-outline-success" href="{{ route('clients.all') }}" role="button">All Clients</a>
        </nav>
        
    </nav>

    <!-- As a heading -->
    <div class="container d-flex justify-content-center pt-5">
        <div class="col-md-9">
            <h2 class="text-center pb-3 text-danger">Add & Remove Clients</h2>
            <form action="{{ route('clients.store') }}" method="POST">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session()->has('success'))
                    <div class="alert alert-success text-center">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                <table class="table table-bordered" id="table">
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="inputs[0][first_name]" placeholder="First Name"
                                class="form-control"></td>
                        <td><input type="text" name="inputs[0][last_name]" placeholder="Last Name"
                                class="form-control"></td>
                        <td><input type="email" name="inputs[0][email]" placeholder="Email" class="form-control"></td>
                        <td><input type="text" name="inputs[0][phone]" placeholder="Phone" class="form-control"></td>
                        <td><input type="text" name="inputs[0][address]" placeholder="Address" class="form-control">
                        </td>
                        <td><button type="button" class="btn btn-danger remove-row">Remove</button></td>
                    </tr>
                </table>

                <button type="button" class="btn btn-secondary mb-3" id="addRow">Add Row</button>
                <button type="submit" class="btn btn-primary col-md-2">Save</button>
            </form>
        </div>
    </div>

    <!-- jQuery CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Custom Script -->
    <script>
        $(document).ready(function() {
            var i = 0;
            $('#addRow').click(function() {
                i++;
                $('#table').append(`
                    <tr>
                        <td><input type="text" name="inputs[${i}][first_name]" placeholder="First Name" class="form-control"></td>
                        <td><input type="text" name="inputs[${i}][last_name]" placeholder="Last Name" class="form-control"></td>
                        <td><input type="email" name="inputs[${i}][email]" placeholder="Email" class="form-control"></td>
                        <td><input type="text" name="inputs[${i}][phone]" placeholder="Phone" class="form-control"></td>
                        <td><input type="text" name="inputs[${i}][address]" placeholder="Address" class="form-control"></td>
                        <td><button type="button" class="btn btn-danger remove-row">Remove</button></td>
                    </tr>
                `);
            });

            $(document).on('click', '.remove-row', function() {
                $(this).closest('tr').remove();
            });
        });
    </script>

</body>

</html>
