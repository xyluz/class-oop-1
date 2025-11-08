<?php include_once 'layouts/header.layout.php'?>



<form action="/profile" method="post">
    <div>
        <label for="email">email</label>
        <input type="text" id="email" name="email">
    </div>

    <div>
        <label for="firstname">firstname</label>
        <input type="text" id="firstname" name="firstname">
    </div>

    <button type="submit">Update Profile</button>
</form>

<?php include_once 'layouts/footer.layout.php'?>