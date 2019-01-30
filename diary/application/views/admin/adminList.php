<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>All Tasks</h1>
            <a href="create" class="btn btn-success">Add Task</a>
            <table class="table">
                <thead>
                <tr>
                    <th>Number task</th>
                    <th>Title</th>
                    <th>Who will do</th>
                </tr>
                </thead>
        </div>
        <tbody>
        <?php foreach ($tasks as $task): ?>
            <tr>
                <td style=''><?= $task['id']; ?></td>
                <td><?= $task['title']; ?></td>
                <td><?= $task['familyMembers']; ?></td>
                <td>
                    <a href="/admin/show/<?= $task['id']; ?>" class="btn btn-info">Show</a>
                    <a href="/admin/edit/<?= $task['id']; ?>" class="btn btn-warning">Edit</a>
                    <a onclick="return confirm('are you sure?');" href="/admin/delete/<?= $task['id']; ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        </table>
    </div>
</div>
</div>
