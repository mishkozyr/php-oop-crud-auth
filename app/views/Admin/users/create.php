<form action="/admin/users/create" method="post">
    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" required>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
    </div>
    <div>
        <label for="role_id">Role ID:</label>
        <select name="role_id" required>
            <option value="1">User</option>
            <option value="2">Admin</option>
        </select>
    </div>
    <div>
        <button type="submit">Create User</button>
    </div>
</form>