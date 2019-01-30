<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Edit Task</h1>
            <form action="/admin/edit/<?php echo $oneTask['id']; ?>" method="post">
                <div class="form-group">
                    <input type="text" name="title" class="form-control" value="<?= $oneTask['title']; ?>">
                </div>
                <div class="form-group">
                    <textarea name="content" class="form-control"><?= $oneTask['content']; ?></textarea>
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
                    <button class="btn btn-warning" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
