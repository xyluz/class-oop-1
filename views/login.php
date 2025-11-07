<?php include_once 'layouts/header.layout.php'?>



<form action="/login" method="post">
    <div>
        <label for="email">email</label>
        <input type="text" id="email" name="email">
    </div>

    <div>
        <label for="password">Password</label>
        <input type="text" id="password" name="password">
    </div>

    <button type="submit">Login</button>
</form>

<?php include_once 'layouts/footer.layout.php'?>