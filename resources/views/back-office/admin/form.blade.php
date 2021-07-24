<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="title">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Name"
                   value="{{isset($user)?$user->name:''}}" required>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="title">E-mail</label>
            <input type="text" class="form-control" name="email" placeholder="E-mail"
                   value="{{isset($user)?$user->email:''}}" required>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group row">
            <label for="password">Password</label>

            <input id="password" type="password" class="form-control"
                   name="password" required autocomplete="new-password">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="password-confirm" >Confirm Password</label>

            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                   autocomplete="new-password">
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="category">Role</label>
            <select class="form-control" name="role_id" id="role" required>
                <option disabled selected>Select Role</option>
                @foreach($roles as $role)
                    <option
                        value="{{$role->id}}">{{ucfirst($role->name)}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
