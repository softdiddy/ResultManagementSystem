<div class="login-box">
<div class="card" >
    <div class="card-body login-card-body col-md-12">
      <p class="login-box-msg">Reset your Password</p>

      <div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Old Password" id="old_pass">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" id="new_pass1">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Re-enter Password" id="new_pass2">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
      </div>

      <div class="social-auth-links text-center mb-3">
			<div id="error" ></div>
        <a href="#" class="btn btn-block btn-success" onclick="setChangePassword()">
          <i class="fab fa-key mr-2"></i> Change Password
        </a>
      </div>


      </div>
      </div>
      </div>