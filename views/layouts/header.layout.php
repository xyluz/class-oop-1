<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: #fff;
            padding: 40px 50px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            width: 520px;
            max-width: 90%;
        }

        nav {
            text-align: center;
            margin-bottom: 20px;
        }

        nav a {
            color: #1976d2;
            text-decoration: none;
            margin: 0 8px;
            font-weight: 500;
        }

        nav a:hover {
            text-decoration: underline;
            color: #0d47a1;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 1.6rem;
        }

        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            column-gap: 25px;  /* space between columns */
            row-gap: 18px;     /* space between rows */
        }

        label {
            display: block;
            font-weight: 500;
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        input:focus {
            border-color: #1976d2;
            outline: none;
        }

        .full-width {
            grid-column: span 2;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #1976d2;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
            grid-column: span 2;
            margin-top: 10px;
        }

        button:hover {
            background-color: #0d47a1;
        }
    </style>
</head>
<body>
<div class="container">

    <p>
        <a href="/">Home</a> | <a href="/login">Login</a> | <a href="/register">Register</a> | <a href="/profile">Profile</a>
    </p>