<div class="container">
    <form method="POST" action="?controller=users&action=register" enctype="multipart/form-data">
        <div class="form-group">
            <label for="example-text-input">Name</label>
            <input class="form-control" type="text" name='name' placeholder="Enter your name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name='email'>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="example-text-input">Password</label>
            <input class="form-control" type="password" name="password" placeholder="Enter a password">
        </div>
        <div class="form-group">
            <label for="example-text-input">Password confirm</label>
            <input class="form-control" type="password" name='password_confirm' placeholder="Confirm the password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>