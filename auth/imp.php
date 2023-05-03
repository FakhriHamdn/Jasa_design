<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<div class="container">
  <form>
    <ul class="form-list">
      <li class="form-row">
        <div class="form-group">
          <label for="firstName">First Name</label>
          <input type="text" class="form-control" id="firstName" placeholder="Enter First Name">
        </div>
        <div class="form-group">
          <label for="lastName">Last Name</label>
          <input type="text" class="form-control" id="lastName" placeholder="Enter Last Name">
        </div>
      </li>
      <li class="form-row">
          <label for="email">Email address</label>
          <input type="email" class="form-control" id="email" placeholder="Enter email">
      </li>
      <li class="form-row">
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" placeholder="Password">
        </div>
        <div class="form-group">
          <label for="confirmPassword">Confirm Password</label>
          <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password">
        </div>
      </li>
    </ul>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>


</body>
</html>