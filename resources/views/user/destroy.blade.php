<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <style>
        form {
            width: 50%;
            margin: auto;
        }
        button {
            padding: 10px 15px;
            background-color: #f44336;
            color: white;
            border: none;
            cursor: pointer;
        }
        button[type="submit"] {
            background-color: #d32f2f;
        }
        a {
            text-decoration: none;
            color: #4CAF50;
            display: block;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Are you sure you want to delete this user?</h1>

    <form action="{{ route('user.destroy', $user->id) }}" method="POST">
        @csrf
        @method('DELETE')

        <button type="submit">Yes, Delete User</button>
    </form>

    <a href="{{ route('user.index') }}">No, Go Back</a>
</body>
</html>
