<?php require_once 'functions.php' ?>
<div class="container" id="flash"> 
    <?php $messages = getMessages(); ?>
    <?php if ($messages) : ?>
        <?php foreach ($messages as $msg) : ?>
            <div class="row justify-content-center">
                <div class="alert alert-<?php se($msg, 'color', 'info'); ?>" role="alert"><?php se($msg, "text", ""); ?></div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<script>
    //used to pretend the flash messages are below the first nav element
    function moveMeUp(ele) {
        let target = document.getElementsByTagName("head")[0];
        //let target = document.getElementById("top")[0];
        if (target) {
            target.after(ele);
        }
    }
    function removeit (flash) {
        setTimeout(() => {
            console.log("removing");
            flash.children[0].remove();
            if (flash.children.length > 0) {
                removeit(flash);
            }

        }, 1500);
    }
    moveMeUp(document.getElementById("flash"));
    removeit (document.getElementById("flash"));
</script>
<style>
    .alert-success {
        margin-top: 10px;
        width:50%;
        text-align:center;
        background-color: green;
    }

    .alert-warning {
        margin-top: 10px;
        width:50%;
        text-align:center;
        background-color: yellow;
    }

    .alert-danger {
        margin-top: 10px;
        width:50%;
        text-align:center;
        background-color: red;
    }

    .alert-info {
        margin-top: 10px;
        width:50%;
        text-align:center;
        background-color: teal;
    }
    .alert-alert {
        margin-top: 10px;
        width:50%;
        text-align:center;
        background-color: #DAF89E;
    }
</style>
</script>