<?php include_once 'layouts/header.layout.php'?>

    <form action="/register" method="post">
        <div>
            <label for="firstname">First Name</label>
            <input type="text" id="firstname" name="firstname">
        </div>

        <div>
            <label for="lastName">Last Name</label>
            <input type="text" id="lastname" name="lastname">
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email">
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
        </div>

        <div>
            <label for="confirmPassword">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password">
        </div>

        <div>
            <label for="phone_number">Phone</label>
            <input type="tel" id="phone_number" name="phone_number">
        </div>

        <button type="submit">Register Now</button>
    </form>

<?php include_once 'layouts/footer.layout.php'?>