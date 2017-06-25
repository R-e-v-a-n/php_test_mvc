<div class="form-task row">
    <img src="/images/<?php echo $task['img']; ?>" style="float: left;">
    <div class="col-xs-offset-6">
        <div class="form-control">Автор: <?php echo $task['username']; ?></div>
    </div>
    <div class="col-xs-offset-6">
        <div class="form-control">E-Mail: <?php echo $task['e-mail']; ?></div>
    </div>
    <div class="col-xs-offset-6">
        <div class="form-control">Статус: <?php echo ($task['status'] == '1'?'Выполнено':'Не выполнено'); ?></div>
    </div>

    <?php if(isset($_SESSION["user_role"]) and $_SESSION["user_role"] == "ROLE_ADMIN") : ?>
    <div class="col-xs-offset-6">
        <form action="/Tasks/Edit" method="post">
            <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
            <button class="btn btn-primary form-control" type="submit">Редактировать</button>
        </form>
    </div>
    <?php endif; ?>
</div>
<div class="form-task well"><?php echo $task['description']; ?></div>
<hr color="red">