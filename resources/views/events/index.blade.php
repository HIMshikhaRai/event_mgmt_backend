<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Event Management Sysytem</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit">Logout</button>
    </form>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Event Management Sysytem</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('events.create') }}"> Create Event</a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Address</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>{{ $event->id }}</td>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->description }}</td>
                        <td>{{ $event->address }}</td>
                        <td>
                            <form action="{{ route('events.destroy',$event->id) }}" method="Post">
                                <a class="btn btn-primary" href="{{ route('events.edit',$event->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        {!! $events->links() !!}
    </div>
</body>
</html>