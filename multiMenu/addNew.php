<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link rel="stylesheet" href="<?php echo $SITEURL; ?>plugins/multiMenu/js/multiMenu.css" />


<style>
    .multiMenu .btn-sm .fas {
        color: #fff;
    }

    .multiMenu .list-group {
        margin: 0 !important
    }
</style>




<h3>MultiMenu Creator</h3>

<div class="row multiMenu">
    <div class="col-md-12">


        <form method="POST">

            <div class="card-header bg-primary text-white">Edit item</div>

            <div class="card-body border mb-2 rounded">


                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" value="<?php

                                                            if (isset($_GET['menuname'])) {
                                                                echo $_GET['menuname'];
                                                            } else {
                                                                echo '';
                                                            }; ?>" class="form-control mb-2">


                    <textarea id="out" class="form-control d-none" name="json" cols="50" rows="10"></textarea>
                    <input type="submit" value="Save Form" name="submit" class="btn btn-danger">


                </div>
            </div>



        </form>

        <div class="card border-primary mb-3">
            <div class="card-header bg-primary text-white">Edit item</div>
            <div class="card-body">
                <form id="frmEdit" class="form-horizontal">
                    <div class="form-group">
                        <label for="text">Text</label>
                        <div class="input-group">
                            <input type="text" class="form-control item-menu" name="text" id="text" placeholder="Text">

                        </div>
                        <input type="hidden" name="icon" class="item-menu">
                    </div>
                    <div class="form-group">
                        <label for="href">URL</label>
                        <select type="text" class="form-control item-menu" id="href" name="href" placeholder="URL">
                            <?php


                            foreach (glob(GSDATAPAGESPATH . '*xml') as $file) {

                                $pureFile = pathinfo($file)['filename'];
                                $xml = simplexml_load_file($file);



                                echo '<option value="' . $pureFile . '">' . $xml->title . '</option>';
                            };
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="target">Target</label>
                        <select name="target" id="target" class="form-control item-menu">
                            <option value="_self">Self</option>
                            <option value="_blank">Blank</option>
                            <option value="_top">Top</option>
                        </select>
                    </div>
                    <div class="form-group d-none">
                        <label for="title">Tooltip</label>
                        <input type="text" name="title" class="form-control item-menu" id="title" placeholder="Tooltip">
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <button type="button" id="btnUpdate" class="btn btn-primary" disabled><i class="fas fa-sync-alt"></i> Update</button>
                <button type="button" id="btnAdd" class="btn btn-success"><i class="fas fa-plus"></i> Add</button>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="float-left">Menu</h5>

            </div>
            <div class="card-body">
                <ul id="myEditor" class="sortableLists list-group">
                </ul>
            </div>
        </div>




    </div>

</div>

</form>



<script src="<?php echo $SITEURL; ?>plugins/multiMenu/js/jquery-menu-editor.js"></script>

<script>
    const ars = {

        <?php

        $count = 1;

        foreach (glob(GSDATAPAGESPATH . '*xml') as $file) {

            $pure = pathinfo($file)['filename'];
            $xml = simplexml_load_file($file);

            $filecount = count(glob(GSDATAPAGESPATH . '*xml'));


            echo '"' . $pure . '":"' . $xml->title . '"';

            if ($filecount > $count) {

                echo ',';
            };

            $count++;
        }; ?>


    };

    jQuery(document).ready(function() {

        var arrayjson =
            <?php

            if (isset($_GET['menuname'])) {
                $folder        = GSDATAOTHERPATH . 'multiMenu/';
                $filename      = $folder . $_GET['menuname'] . '.json';
                echo  file_get_contents($filename);
            } else {
                echo '[]';
            }; ?>

        ;



        // icon picker options
        var iconPickerOptions = {

        };
        // sortable list options
        var sortableListOptions = {
            placeholderCss: {
                'background-color': "#cccccc"
            }
        };

        var editor = new MenuEditor('myEditor', {
            listOptions: sortableListOptions
        });

        editor.setData(arrayjson);


        var str = editor.getString();
        $("#out").text(str);

        editor.setForm($('#frmEdit'));
        editor.setUpdateButton($('#btnUpdate'));
        $('#btnReload').on('click', function() {
            editor.setData(arrayjson);
            var str = editor.getString();
            $("#out").text(str);
        });

        $('#btnOutput').on('click', function() {
            var str = editor.getString();
            $("#out").text(str);
        });

        $('#btnOutput').on('mousedown', function() {
            var str = editor.getString();
            $("#out").text(str);
        });

        $("#btnUpdate").click(function() {
            editor.update();
            var str = editor.getString();
            $("#out").text(str);
        });

        $('#btnAdd').click(function() {
            editor.add();
            var str = editor.getString();
            $("#out").text(str);
        });


        $('#myEditor').click(function() {

            var str = editor.getString();
            $("#out").text(str);

        });


        $('#href').click(function() {

            $('#text').val(
                ars[$('#href').val()]
            );
        });






    });
</script>



<?php

if (isset($_POST['submit'])) {


    global $SITEURL;
    global $GSADMIN;
    $folder        = GSDATAOTHERPATH . 'multiMenu/';
    $filename      = $folder . $_POST['title'] . '.json';
    $chmod_mode    = 0755;
    $folder_exists = file_exists($folder) || mkdir($folder, $chmod_mode);
    $jsonData = $_POST['json'];

    if (empty($_POST['json'])) {
        $jsonData = '[]';
    }

    if ($folder_exists) {
        file_put_contents($filename, $jsonData);

        echo ("<meta http-equiv='refresh' content='0'>");

        echo '<script>window.location.href = "' . $SITEURL . $GSADMIN . '/load.php?id=multiMenu&addMultiMenu&menuname=' . $_POST['title'] . '"</script>';
    };
};; ?>