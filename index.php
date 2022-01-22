<?php
include("includes/header.php");
include("includes/classes/User.php");
include("includes/classes/Post.php");

if(isset($_POST['post'])) {

    // Upload image to post
    $uploadOk = 1;
    $imageName = $_FILES['fileToUpload']['name'];
    $errorMessage = "";

    if($imageName != ""){
        $targetDir = "assets/images/posts/";
        $imageName = $targetDir . uniqid() . basename($imageName);
        $imageFileType = pathinfo($imageName, PATHINFO_EXTENSION);

        if($_FILES['fileToUpload']['size'] > 10000000){
            $errorMessage = "The file is too big!";
            $uploadOk = 0;
        }

        if(strtolower($imageFileType) != "jpeg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpg"){
            $errorMessage = "Only JPEG, JPG, and PNG Files are allowed.";
            $uploadOk = 0;
        }

        if($uploadOk){
            if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $imageName)){ // The image was uploaded
            }
            else{ // The image ended up not uploading
                    $uploadOk = 0;
            }
        }

    }

    if($uploadOk){
        $post = new Post($con, $userLoggedIn);
        $post->submitPost($_POST['post-text'], 'none', $imageName);
    }
    else{
        echo '<script type="text/javascript">','alert("Your files cannot be uploaded, try again.")','</script>';

    }


    $post = new Post ($con, $userLoggedIn);
    $post -> submitPost($_POST['post_text'], 'none', $imageName);
    header('location:index.php');
}
?>

<div class="columnholder_center">

<div class="columnholder">

    <div class="leftcolumn">

    <div class="user_details2">
            <a href="<?php echo $userLoggedIn; ?>">
            <?php 
            echo $user['first_name'] . " " . $user['last_name'];
            ?> </a> 
            </div>
        <br><br>

        <div class="user_details1">
        <a href="<?php echo $userLoggedIn; ?>"> <img src="<?php echo $user['profile_pic'] ?>"> </a>
        </div>

        <br>

        <div class="user_details3">
        <?php 
        echo "Posts: " . $user['num_posts']. "<br>";
        ?>
        </div>

        <br><br>

        <div class="user_details4">
        <?php 
        echo "Likes: " . $user['num_likes']. "<br>";
        ?>
        </div>
    </div> 


    <div class="rightcolumn">
        <div class="postbox">
        <form class="post_form" action="index.php" method="POST" enctype="multipart/form-data">
        <textarea name="post_text" id="post_text" placeholder="Cat got your tongue?"></textarea>
        
        <br>
        <input type="submit" name="post" id="post_button" value="Paw!">
        <input type="file" name="fileToUpload" id="fileToUpload" >
        </form>

        <div class="posts_area"></div>
            <img id="loading" src="assets/images/icons/loading.gif">
        </div>
    </div>

</div>

<script>

    var userLoggedIn = '<?php echo $userLoggedIn; ?>';

    $(document).ready(function() {

        $('#loading').show();

        $.ajax({
            url: "includes/handlers/ajax_load_posts.php",
            type: "POST",
            data: "page=1&userLoggedIn=" + userLoggedIn,
            cache:false,

            success: function(data) {
                $('#loading').hide();
                $('.posts_area').html(data);
            }
        });

        $(window).scroll(function() {
            var height = $('.posts_area').height(); //DIV containing posts
            var scroll_top = $(this).scrollTop();
            var page = $('.posts_area').find('.nextPage').val();
            var noMorePosts = $('.posts_area').find('.noMorePosts').val();

            if((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
                $('#loading').show();
            
            var ajaxReq = $.ajax({
            url: "includes/handlers/ajax_load_posts.php",
            type: "POST",
            data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
            cache:false,

            success: function(response) {
                $('.posts_area').find('.nextPage').remove();
                $('.posts_area').find('.noMorePosts').remove();

                $('#loading').hide();
                $('.posts_area').append(response);
            }
        });

    } //end if

            return false;

        }); //end 

    });

    </script>


    </div>
</body>
</html>