<?php require APPROOT . '/views/inc/header.php';?>
<div class="jumbotron jubotron-flud text-center">
    <div class="container">
        <h2 class="display-3"><?php echo $data['title']; ?></h2>
        <p class="lead"><?php echo $data['description'] ?></p>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php';?>


<!-- 
    require: Just include the file everytime it gets 
    called. Without this file, the app would crash
     (like templates and so on)

require_once: php checks if the file is already included or not.
 If not, load it, if yes, don't load it again.
 -->
