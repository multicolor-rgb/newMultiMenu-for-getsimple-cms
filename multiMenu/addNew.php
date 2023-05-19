<?php

if (isset($_GET['menuname'])) {
    $classFile = file_get_contents(GSDATAOTHERPATH . 'multiMenu/folderClass/' . $_GET['menuname'] . '-class.json');
    $jsClass = json_decode($classFile);
};; ?>

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



<form method="POST">

    <h3>MultiMenu Creator</h3>

    <div class="row multiMenu">
        <div class="col-md-12">



            <div class="card-header bg-primary text-white"><i class="fa-solid fa-file"></i> Title settings</div>

            <div class="card-body border mb-2 rounded">


                <div class="form-group">

                    <label for="title"> Title Menu (without space and special characters)</label>
                    <input type="text" required name="title" pattern="[a-zA-Z0-9]+" value="<?php

                                                                                    if (isset($_GET['menuname'])) {
                                                                                        echo $_GET['menuname'];
                                                                                    } else {
                                                                                        echo '';
                                                                                    }; ?>" class="form-control mb-2">

                </div>
            </div>


            <div class="card class-options mb-2 ">
                <div class="card-header bg-primary text-light"><i class="fa-solid fa-bars"></i> Custom class ( click to show)</div>
                <div class="card-body text-light">

                    <label>

                        <input type="radio" name="active" value="a" <?php
                                                                    if (isset($_GET['menuname'])) {

                                                                        if ($jsClass->active == 'a') {
                                                                            echo 'checked';
                                                                        }
                                                                    }; ?>> Active class on [a]
                    </label>

                    <label>
                        <input type="radio" name="active" value="li" class="ml-2" <?php
                                                                                    if (isset($_GET['menuname'])) {

                                                                                        if ($jsClass->active == 'li') {
                                                                                            echo 'checked';
                                                                                        }
                                                                                    }; ?>> Active class on [li]
                    </label>


                    <div class="form-group">
                        <label for="title"> class for menu</label>
                        <input type="text" name="classul" <?php
                                                            if (isset($_GET['menuname'])) {
                                                                echo  'value="' . $jsClass->classul . '" ';
                                                            }; ?> class=" form-control mb-2">
                    </div>




                    <div class="form-group">
                        <label for="title"> class for menu > li</label>
                        <input type="text" name="classulli" <?php
                                                            if (isset($_GET['menuname'])) {
                                                                echo  'value="' . $jsClass->classulli . '" ';
                                                            }; ?> class="form-control mb-2">
                    </div>




                    <div class="form-group">
                        <label for="title"> class for menu > li > a</label>
                        <input type="text" name="classullia" <?php
                                                                if (isset($_GET['menuname'])) {
                                                                    echo  'value="' . $jsClass->classullia . '" ';
                                                                }; ?> class="form-control mb-2">
                    </div>



                    <div class="form-group">
                        <label for="title"> class for menu > li > ul</label>
                        <input type="text" name="classulliul" <?php
                                                                if (isset($_GET['menuname'])) {
                                                                    echo  'value="' . $jsClass->classulliul . '" ';
                                                                }; ?> class="form-control mb-2">
                    </div>


                    <div class="form-group">
                        <label for="title"> class for menu > li > ul > li</label>
                        <input type="text" name="classulliulli" <?php
                                                                if (isset($_GET['menuname'])) {
                                                                    echo  'value="' . $jsClass->classulliulli . '" ';
                                                                }; ?> class="form-control mb-2">
                    </div>

                    <div class="form-group">
                        <label for="title"> class for menu > li > ul > li > a</label>
                        <input type="text" name="classulliullia" <?php
                                                                    if (isset($_GET['menuname'])) {
                                                                        echo  'value="' . $jsClass->classulliullia . '" ';
                                                                    }; ?> class="form-control mb-2">
                    </div>

                </div>
            </div>





            <div class="card border-primary mb-3 edit-items">
                <div class="card-header bg-primary text-white"><i class="fa-solid fa-link"></i> Edit items (click to show)</div>
                <div class="card-body">
                    <div id="frmEdit" class="form-horizontal">
                        <div class="form-group">
                            <label for="text">Text</label>
                            <div class="input-group">
                                <input type="text" class="form-control item-menu" name="text" id="text" placeholder="Text">

                            </div>
                            <input type="hidden" name="icon" class="item-menu">
                        </div>



                        <div class="form-group">
                            <label for="href">URL</label>
                            <select type="text" class="form-control item-menu href-maker" id="href" name="href" placeholder="URL">
                                <option value="extlink" class="form-control">Extrernal link</option>
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
                            <input type="text" name="titletooltip" class="form-control item-menu" id="title" placeholder="Tooltip">
                        </div>
                    </div>

                    <div class="border p-2 bg-light">
                        <button type="button" id="btnUpdate" class="btn btn-primary" disabled><i class="fas fa-sync-alt"></i> Update</button>
                        <button type="button" id="btnAdd" class="btn btn-info"><i class="fas fa-plus"></i> Add</button>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header bg-info text-white">
                    <i class="fa-solid fa-bars"></i> Menu

                </div>
                <div class="card-body">
                    <ul id="myEditor" class="sortableLists list-group">
                    </ul>
                </div>
            </div>







            <textarea id="out" class="form-control d-none" name="json" cols="50" rows="10"></textarea>

            <div class="bg-light border mb-2 p-2 mt-2 d-flex ">
                <input type="submit" value="Save Menu" name="submit" class="btn d-block btn-success">

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





        //

        document.querySelector('.class-options').style.cursor = "pointer";

        document.querySelector('.class-options').querySelector('.card-body').classList.add('d-none');
        document.querySelector('.class-options').querySelector('.card-header').addEventListener('click', () => {
            document.querySelector('.class-options').querySelector('.card-body').classList.toggle('d-none');
        })



        document.querySelector('.edit-items').style.cursor = "pointer";

        document.querySelector('.edit-items').querySelector('.card-body').classList.add('d-none');
        document.querySelector('.edit-items').querySelector('.card-header').addEventListener('click', () => {
            document.querySelector('.edit-items').querySelector('.card-body').classList.toggle('d-none');
        })





        let count = 0;




        if (document.querySelector('.href-maker').value == 'extlink') {


            if (document.querySelector('.href-maker').value == 'extlink') {

                const inputer = document.createElement('input');
                document.querySelector('.href-maker').classList.remove('item-menu');
                inputer.setAttribute('name', 'href');
                inputer.setAttribute('id', 'href');
                inputer.setAttribute('placeholder', 'https://google.pl')
                inputer.classList.add('item-menu', 'form-control', 'inputer', 'mt-2');

                if (document.querySelector('.inputer') == undefined) {
                    document.querySelector('.href-maker').after(inputer);
                }


            } else {

                if (document.querySelector('.inputer') !== null) {
                    document.querySelector('.inputer').remove();
                }

            };


        };



        document.querySelector('.href-maker').addEventListener('click', () => {


            if (document.querySelector('.href-maker').value == 'extlink') {

                const inputer = document.createElement('input');
                document.querySelector('.href-maker').classList.remove('item-menu');
                inputer.setAttribute('name', 'href');
                inputer.setAttribute('id', 'href');
                inputer.setAttribute('placeholder', 'https://google.pl')
                inputer.classList.add('item-menu', 'form-control', 'inputer', 'mt-2');

                if (document.querySelector('.inputer') == undefined) {
                    document.querySelector('.href-maker').after(inputer);
                }


            } else {

                if (document.querySelector('.inputer') !== null) {
                    document.querySelector('.inputer').remove();
                    document.querySelector('.href-maker').classList.add('item-menu');
                }

            };


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
    $folderClass    = $folder . 'folderClass/';
    $classFile = $folderClass . $_POST['title'] . '-class.json';

    $jsonClass = array("active" => @$_POST['active'], "classul" => @$_POST['classul'], "classulli" => @$_POST['classulli'], "classullia" => @$_POST['classullia'], "classulliul" => @$_POST['classulliul'], "classulliulli" => @$_POST['classulliulli'], "classulliullia" => @$_POST['classulliullia']);




    if (empty($_POST['json'])) {
        $jsonData = '[]';
    }

    if ($folder_exists) {
        file_put_contents($filename, $jsonData);
        mkdir($folderClass, 0755);
        file_put_contents($classFile, json_encode($jsonClass));

        echo $_POST['title'];
        echo ("<meta http-equiv='refresh' content='0'>");

        echo '<script>window.location.href = "' . $SITEURL . $GSADMIN . '/load.php?id=multiMenu&addMultiMenu&menuname=' . $_POST['title'] . '"</script>';
    };
};; ?>