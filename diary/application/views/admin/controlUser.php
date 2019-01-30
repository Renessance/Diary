<div class="containe">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-5">
            <form action="/admin/controlUser" method="post">
              <h2>Create user</h2>
                <div class="form-group">
                    <label for="email">Email address:</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="form-group">
                    <label for="login">login:</label>
                    <input type="text" class="form-control" name="login">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group">
                    <label for="sel1">family members</label>
                    <select class="form-control" id="sel1" name="familyMembers">
                        <option>Father</option>
                        <option>Mother</option>
                        <option>Child</option>
                    </select>
                    <button type="submit" class="btn btn-default">Create</button>
            </form>
        <h2>Delete user</h2>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Email</th>
                                <th>Login</th>
                                <th>family members</th>
                            </tr>
                            </thead>
                            <tbody>
							<?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?=$user['email'];?></td>
                                    <td><?=$user['login'];?></td>
                                    <td><?=$user['familyMembers'];?></td>
                                    <td>
                                        <a onclick="return confirm('are you sure?');" href="/admin/deleteUser/<?=$user['id'];?>" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
							<?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>