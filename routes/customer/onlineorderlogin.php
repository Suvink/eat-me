<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Global Styles -->
    <link rel="stylesheet" href="../../css/style.css" />
    <title>Login - EatME</title>
</head>
<body>
   <div class="navbar">
      <div class="columns group">
        <div class="column is-2">
          <img src="../../img/logo.png" height="56" width="224" />
        </div>
        <div class="column is-10"></div>
      </div>
    </div>

    <div class="container has-text-centered">
        <h1 class="title mb-1 mt-0">Login</h1>
        <img class="mt-0 mb-0" src="../../img/login.jpg" height="150" />
        <center>
        <form action="">
            <label class="field artemis-input-field">
                <input class="artemis-input" type="text" placeholder="Your Username here" required>
                <span class="label-wrap">
                    <span class="label-text">Username</span>
                </span>
            </label>
            <label class="field artemis-input-field">
                <input class="artemis-input" placeholder="Your Password here" type="password" required>
                <span class="label-wrap">
                    <span class="label-text">Password</span>
                </span>
            </label>
            <button class="button is-primary">Login</button>
          </form>
      </center>
    </div>
    
</html>