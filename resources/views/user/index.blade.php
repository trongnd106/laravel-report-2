<!-- resources/views/user/index.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
</head>
<body>
    <h1>User List</h1>

    <a href="{{ route('user.create') }}">Create New User</a>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <!-- Add Edit and Delete buttons here -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
