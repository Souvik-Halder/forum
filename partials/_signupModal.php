



<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="/Forum/partials/_signuphandle.php"  method="POST">
  <div class="mb-3">
    
  
  <label for="exampleInputEmail1">Username</label>

<input type="email" class="form-control" id="email" name="signupEmail"
    saria-describedby="emailHelp">

<div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    
  <label for="exampleInputPassword1">Password</label>

                        <input type="password" class="form-control" id="password" name="signuppassword">
  </div>
  <div class="mb-3">
    
  <label for="exampleInputPassword1">Confirm Password</label>

<input type="password" class="form-control" id="cpassword" name="signupcpassword">
  </div>
  
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
      </div>
      
      
    </div>
  </div>
</div>



