<div align="center">
    <h2>.::Список задачек::.</h2>
    <hr color="red"/>
    <form action="/Tasks/Sort" method="post" class="form-task form-inline text-center">
        <div class="form-group">
            <button type="submit" class="btn btn-primary form-control">Сортировать</button>
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
        $pages_info = $data['pages_info'];
        $items_info = $data['items_info'];

        if($pages_info['count'] > 1)
        {
            $start = $pages_info["current_page"] - 3 < 1 ? 1 : $pages_info["current_page"] - 3;
            $end   = $start + 3 > $pages_info['count'] ? $pages_info['count'] : $start + 3;

            $page = $pages_info["current_page"] + 1;
            ?>
            <div class='form-task text-right'>
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-lg">
                        <li <?php echo $page > 1 ? '' : 'class="disabled"'; ?>>
                            <a href="<?php echo $page == 1 ? '#' : ($page - 1 == 1 ? "/Tasks/Show" : "/Tasks/Show/$i") ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php
                            for ($i = $start; $i <= $end; $i++)
                            {
                                if($page == $i)
                                {
                                    echo "<li class='active'><a href='#'>$i<span class='sr-only'>(current)</span></a></li>";
                                }
                                else
                                {
                                    echo "<li><a href='".($i == 1 ? "/Tasks/Show" : "/Tasks/Show/$i")."'>$i</a></li>";
                                }
                            }
                        ?>
                        <li <?php echo $page == $pages_info["count"] ? 'class="disabled"' : ''; ?>>
                            <a href="<?php echo $page == $pages_info["count"] ? "#" : "/Tasks/Show/".($page + 1); ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <?php
        }

        foreach($data['items'] as $task)
        {
            include 'task_row.php';
        }
    ?>
</div>
