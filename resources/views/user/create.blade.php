<!-- resources/views/user/create.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
</head>
<body>
    <h1>Create User</h1>
    
    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>

        <label for="department_id">Department:</label>
        <input type="text" name="department_id" id="department_id" require><br><br>

        <button type="submit">Create</button>
    </form>
</body>
</html>
