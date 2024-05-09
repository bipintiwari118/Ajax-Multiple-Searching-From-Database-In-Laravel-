<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Multiple Searching</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <br><br>
        <div class="form-group">

            <div class="col-sm-6">
                <input type="search" class="form-control" id="search" placeholder="Search" name="search">

            </div>
        </div>
        <br>
        <br>


        <table class="table table-bordered table-hover">
            <thead>
                @if(count($users)>0)
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                </tr>
                @else
                <tr>
                    <td>Users Not Found.</td>
                </tr>

                @endif

            </thead>
            <tbody id="tbody">
                @foreach ($users as $user)
                    <tr>
                       <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email}}</td>
                        <td>{{ $user->phone}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function(){
          $("#search").on('keyup',function(){
            var value = $(this).val();
            $.ajax({
                url:'{{ route('usersearch') }}',
                type:'GET',
                data:{'search':value},
                success:function(users){

                    var users = users.users;
                    var html = '';
                    if(users.length>0){
                        for(let i=0;i<users.length;i++){
                            html +='<tr>\
                                <td>'+users[i]['id']+'</td>\
                                <td>'+users[i]['name']+'</td>\
                                <td>'+users[i]['email']+'</td>\
                                <td>'+users[i]['phone']+'</td>\
                                    </tr>';
                        }
                    }else{
                        html +='<tr>\
                            <td>No Users Found </td>\
                            </tr>';

                    }
                    $('#tbody').html(html);
                }

            });
          });
        });
        </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
