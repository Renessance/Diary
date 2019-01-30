<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Hello</h1>
            <h1><?= $oneTask['title']; ?></h1>
            <p><?= $oneTask['content']; ?><p>
            <form action="/main/show/<?php echo $oneTask['id']; ?>" method="post">
                <select name="title">
                    <option value="Complite">Complite</option>
                    <option value="Did not">Did not</option>
                </select>
                <input type="submit" value="Submit"/>
            </form>
        </div>
    </div>
</div>
