<?php include('includes/header.php'); ?>
<!-- ^^^ Header Include -->

<article>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <fieldset>

        <label>User Name</label>
        <input type="text" name="user_name" value="<?php if(isset($_POST['user_name'])){echo $_POST['user_name'];} ?>">

        <label>Password</label>
        <input type="password" name="password">

        <button type="submit" id="submit_button" class="btn" name="login_user">Log in</button>

        <button type="reset" id="reset_button" class="btn">RESET</button>

        <p class="errors"><?php
            foreach($errors as $error){
                echo $error;
            }
        ?></p>

    </fieldset>
</form>

</article>


<!-- vvv Footer Include -->
<?php include('includes/footer.php'); ?>