<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>All Tasks</h1>
            <table class="table">
                <thead>
                <tr>
                    <th>Number task</th>
                    <th>Title</th>
                    <th>Who will do</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= $task['id']; ?></td>
                        <td><?= $task['title']; ?></td>
                        <td><?= $task['familyMembers']; ?></td>
                        <td>
                            <a href="/main/show/<?= $task['id']; ?>" class="btn btn-info">
                                Show
                            </a>
                            <a href="edit/<?= $task['id']; ?>" class="btn btn-warning">
                                Edit
                            </a>
                            <a onclick="return confirm('are you sure?');" href="delete/<?= $task['id']; ?>"
                               class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
