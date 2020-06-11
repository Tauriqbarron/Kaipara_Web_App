<form method="POST" action="{{url('/registration/address')}}">
    <div class="form-group row">
        <label for="firstname" class="col-sm-2 col-form-label">First Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="firstname" name="firstname">
        </div>
    </div>
    <div class="form-group row">
        <label for="lastnname" class="col-sm-2 col-form-label">Last Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="lastname" name="lastname">
        </div>
    </div>
    <div class="form-group row">
        <label for="username" class="col-sm-2 col-form-label">User Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="username" name="username">
        </div>
    </div>
    <div class="form-group row">
        <label for="password" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="password" name="password">
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email">
        </div>
    </div>
    <div class="form-group row">
        <label for="phone" class="col-sm-2 col-form-label">Phone Number</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="phone">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
