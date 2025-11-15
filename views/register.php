<?php include_once 'layouts/header.layout.php'?>

    <form action="/register" method="post">
        <div>
            <label for="firstname">First Name</label>
            <input type="text" id="firstname" name="firstname" value="Seyi">
        </div>

        <div>
            <label for="lastName">Last Name</label>
            <input type="text" id="lastname" name="lastname" value="Onifade">
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="seyi@zuri.team">
        </div>

        <div>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="seyiOnifade">
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" value="National1">
        </div>

        <div>
            <label for="confirmPassword">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" value="National1">
        </div>

        <div>
            <label for="phone_number">Phone</label>
            <input type="tel" id="phone_number" name="phone_number" value="08160614229">
        </div>

        <div>
            <label for="dob">Date of Birth</label>
            <input type="date" id="dob" name="dob" value="11/11/2025">
        </div>

        <button type="submit">Register Now</button>
    </form>

<?php include_once 'layouts/footer.layout.php'?>