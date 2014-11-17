<div class="row">
    <h1>Register</h1>
    <?php if(isset($message)) echo $message;?>
    <div class="col-xs-12">
        <form role="form" method="post">
            <div class="form-group">
                <label for="UserName">Username</label>
                <input type="text" class="form-control" id="UserName" name="username" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label for="InputPassword">Password</label>
                <input type="password" class="form-control" id="InputPassword" name="password" placeholder="Password">
                <div> Must be at least 8 characters.</div>
            </div>
            <div class="form-group">
                <label for="InputPasswordAgain">Confirm Password</label>
                <input type="password" class="form-control" id="InputPasswordAgain" name="passconf" placeholder="Confirm Password">
            </div>
            <div class="form-group">
                <label for="InputEmail">Email address</label>
                <input type="email" class="form-control" id="InputEmail" name="email" placeholder="Enter email">
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="accept" name="accept"> I agree to terms and services.
                </label>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>

</div>