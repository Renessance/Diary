<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Create Task</h1>
            <form action="/main/mother" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="title">
                </div>

                <div class="form-group">
                    <textarea name="content" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="sel1">family members</label>
                    <select class="form-control" id="sel1" name="familyMembers">
                        <option>Father</option>
                        <option>Mother</option>
                        <option>Child</option>
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-success" value="" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
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
                        </td>
                        <td>
                            <a href="/main/show/<?= $task['id']; ?>" class="btn btn-info">Show</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
