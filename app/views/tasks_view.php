<div align="center">
    <h2>.::Список задачек::.</h2>
    <hr color="red"/>
    <?php
        $pages_info = $data['pages_info'];
        $items_info = $data['items_info'];

        if($pages_info['count'] > 1)
        {
            $start = $pages_info["current_page"] - 3 < 1 ? 1 : $pages_info["current_page"] - 3;
            $end   = $start + 3 > $pages_info['count'] ? $pages_info['count'] : $start + 3;
            echo 'Страницы: ';

            echo "<a href='/Tasks/Show'>Первая</a> ";
            for ($i = $start; $i <= $end; $i++)
            {
                echo " [<a href='/Tasks/Show".($i > 1 ? "/$i" : "")."'>$i</a>] ";
            }
            echo " <a href='/Tasks/Show/$pages_info[count]'>Последняя </a>";
        }
    ?>
    <form action="/Tasks/Sort" method="post" class="form-task form-inline text-center">
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Сортировать</button>
            <select name="order_fld" class="form-control">
                <option value="id"       <?php if($_SESSION['order_fld'] == 'id')       echo 'selected'?>>В порядке добавления</option>
                <option value="username" <?php if($_SESSION['order_fld'] == 'username') echo 'selected'?>>по имени пользователя</option>
                <option value="e-mail"   <?php if($_SESSION['order_fld'] == 'e-mail')   echo 'selected'?>>по E-Mail</option>
                <option value="status"   <?php if($_SESSION['order_fld'] == 'status')   echo 'selected'?>>по статусу</option>
            </select>
            <select name="order_dir" class="form-control">
                <option value="ASC"  <?php if($_SESSION['order_dir'] == 'ASC')       echo 'selected'?>>По возрастанию</option>
                <option value="DESC" <?php if($_SESSION['order_dir'] == 'DESC')      echo 'selected'?>>По убыванию</option>
            </select>
        </div>
    </form>
    <hr color="red">

    <?php
    foreach($data['items'] as $task)
    {
        include 'task_row.php';
    }
    ?>
</div>
