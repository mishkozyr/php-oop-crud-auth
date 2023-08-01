<form action="/admin/users/update" method="post">
        <input type="hidden" name="id" value="<?= $user['id'] ?>"> 
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?= $user['name'] ?>"> 

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?= $user['email'] ?>"> 

        <label for="role_id">Role:</label>
        <select name="role_id">
            <option value="1" <? if ($user['role_id'] == 1) echo 'selected'; ?>>User</option>
            <option value="2" <? if ($user['role_id'] == 2) echo 'selected'; ?>>Admin</option>
        </select>
        
        <button type="submit">Update User</button>
</form>