<div class="modal fade" id="mdlAddUser" tabindex="-1" role="dialog" aria-labelledby="mdlAddUser" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Add User</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <form id="frmAddUser" method="post" action="{{ route('register.perform') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group form-floating mb-3">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                placeholder="Name" required="required" autofocus>
                            <label for="floatingName">Name</label>
                            @if ($errors->has('name'))
                                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group form-floating mb-3">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                placeholder="name@example.com" required="required" autofocus>
                            <label for="floatingEmail">Email address</label>
                            @if ($errors->has('email'))
                                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="form-group form-floating mb-3">
                            <input type="text" class="form-control" name="username" value="{{ old('username') }}"
                                placeholder="Username" required="required" autofocus>
                            <label for="floatingName">Username</label>
                            @if ($errors->has('username'))
                                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                            @endif
                        </div>
                        <div class="form-group form-floating mb-3">
                            <select class="form-select" id="role" name="role"
                                aria-label="Floating label select example">
                                <option value=""></option>
                            </select>
                            <label for="role">Role</label>
                        </div>
                        <div class="form-group form-floating mb-3">
                            <input type="password" class="form-control" name="password" value="{{ old('password') }}"
                                placeholder="Password" required="required">
                            <label for="floatingPassword">Password</label>
                            @if ($errors->has('password'))
                                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                            @endif
                        </div>

                        <div class="form-group form-floating mb-3">
                            <input type="password" class="form-control" name="password_confirmation"
                                value="{{ old('password_confirmation') }}" placeholder="Confirm Password"
                                required="required">
                            <label for="floatingConfirmPassword">Confirm Password</label>
                            @if ($errors->has('password_confirmation'))
                                <span
                                    class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                    </form>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="frmAddUser" class="btn btn-sm btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="mdlUpdateUser" tabindex="-1" role="dialog" aria-labelledby="mdlUpdateUser"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Update User</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <form id="frmUpdateUser">
                        @csrf
                        <div class="form-group form-floating mb-3">
                            <input type="text" id="update_name" class="form-control" name="name"
                                value="{{ old('name') }}" placeholder="Name" required="required" autofocus>
                            <label for="floatingName">Name</label>
                            @if ($errors->has('name'))
                                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group form-floating mb-3">
                            <input type="email" id="update_email" class="form-control" name="email"
                                value="{{ old('email') }}" placeholder="name@example.com" required="required"
                                autofocus>
                            <label for="floatingEmail">Email address</label>
                            @if ($errors->has('email'))
                                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="form-group form-floating mb-3">
                            <input type="text" id="update_username" class="form-control" name="username"
                                value="{{ old('username') }}" placeholder="Username" required="required" autofocus>
                            <label for="floatingName">Username</label>
                            @if ($errors->has('username'))
                                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                            @endif
                        </div>
                        <div class="form-group form-floating mb-3">
                            <select class="form-select" id="update_role_id" name="role"
                                aria-label="Floating label select example">
                                <option value=""></option>
                            </select>
                            <label for="update_role_id">Role</label>
                        </div>
                    </form>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="frmUpdateUser" class="btn btn-sm btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>
