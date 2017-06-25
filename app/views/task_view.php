<?php
    echo "<div align='center'>";

    if($data["action"] == "add")     echo "<h2 align='center'>.::Добавление задачки::.</h2>";
    if($data["action"] == "edit")    echo "<h2 align='center'>.::Редактирование задачки::.</h2>";
    echo "<hr color=\"red\"/>";

    if(!empty($data["action_status"]))
    {
        if($data["action_status"]=="success")      echo "<h3 style='color:green;'>Задачка добавлена.</h3>";
        elseif($data["action_status"]=="error")    echo "<h3 style='color:red;'>Произошла ошибка({$data['error']}).</h3>";
    }

    if($data["action"] == "add")
    {
        ?>
        Предварительный просмотр: <a href="#" onclick="$('#preview').show();">Показать</a> | 
        <a href="#" onclick="$('#preview').hide();">Скрыть</a>
        <div id="preview" style="display: none;">
            <hr color="red">
            <div class="form-task row">
                <img id="preview_image" style="float: left;">
                <div class="col-xs-offset-6">
                    <div class="form-control">Автор: <span id="preview_username"></span></div>
                </div>
                <div class="col-xs-offset-6">
                    <div class="form-control">E-Mail: <span id="preview_e-mail"></span></div>
                </div>
                <div class="col-xs-offset-6">
                    <div class="form-control">Статус: Не выполнено</div>
                </div>
            </div>
            <div class="form-task row">
                <textarea class="form-control" readonly="readonly" id="preview_description"></textarea>
            </div>
            <hr color="red">
        </div>
        <?php
    }

    echo "<form action='' id='task_form' class='form form-task' enctype='multipart/form-data' method='post'>";

    if($data["action"] == "edit")
    {
        echo "<input type='hidden' name='id' value='{$data['id']}'>";
    }

    if($data["action"] == "add")
    {
        echo "<input type='text' name='username' maxlength='15' class='form-control'".
            " placeholder='Username' autofocus='true'".
            " value='".(empty($data['username']) ? '' : $data['username'])."' required>";
    }
    elseif($data["action"] == "edit")
    {
        echo "<div class='row'>".
            "<div class='col-xs-4'><div class='form-control'>Username:</div></div>".
            "<div class='col-xs-8'><div class='form-control'>".$data["username"]."</div></div>".
            "</div>";
    }

    if($data["action"] == "add")
    {
        echo "<input type='email' name='e-mail' maxlength='50' class='form-control' placeholder='E-Mail'".
            " value='".(empty($data['e-mail']) ? '' : $data['e-mail'])."' required>";
    }
    elseif($data["action"] == "edit")
    {
        echo "<div class='row'>".
            "<div class='col-xs-4'><div class='form-control'>E-Mail:</div></div>".
            "<div class='col-xs-8'><div class='form-control'>".$data["e-mail"]."</div></div>".
            "</div>";
    }

    if($data["action"] == "add")
    {
        echo "<input type='file' class='form-control' name='img' accept='image/jpeg,image/gif,image/png' id='file' required>";
    }
    elseif($data["action"] == "edit")
    {
        echo "<div class='row'>".
            "<div class='col-xs-4'><div class='form-control'>Статус задачки:</div></div>".
            "<div class='col-xs-8'>".
            "<select name='status' class='form-control'>".
            "<option value='0' ".($data["status"] == 0 ? 'selected' : '').">Не выполнено</option>".
            "<option value='1' ".($data["status"] == 1 ? 'selected' : '').">Выполнено</option>".
            "</select></div></div>";
    }

    echo "<textarea maxlength='2000' class='form-control col-xs-12' style='height: 200px' name='description'".
        " placeholder='Type here task description.' required>".
        (empty($data['description']) ? '' : $data['description']).
        "</textarea>";

    echo "<button class=\"btn btn-lg btn-primary btn-block\" type=\"submit\">";

    if(     $data['action'] == 'add')   echo 'Добавить';
    elseif ($data['action'] == 'edit')  echo 'Изменить';
    else                                echo '';

    echo "</button>";

    echo "</form>";
    echo "</div>";

    if($data["action"] == "add")
    {
        ?>
        <script>
                function handleFileSelect(evt) {
                var file = evt.target.files;
                var f = file[0];

                if (!f.type.match('image.*')) {
                    alert("Image only please....");
                }
                var reader = new FileReader();

                reader.onload = (function(theFile) {
                    return function(e) {
                        document.getElementById('preview_image').src = e.target.result;
                    };
                })(f);

                reader.readAsDataURL(f);
            }

            document.getElementById('file').addEventListener('change', handleFileSelect, false);
            document.forms["task_form"].elements["username"].addEventListener('change', function (){
                document.getElementById("preview_username").innerText = this.value;
            });
            document.forms["task_form"].elements["e-mail"].addEventListener('change', function (){
                document.getElementById("preview_e-mail").innerText = this.value;
            });
            document.forms["task_form"].elements["description"].addEventListener('change', function (){
                document.getElementById("preview_description").innerText = this.value;
            });

        </script>
        <?php
    }
?>
