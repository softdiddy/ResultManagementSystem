<?php
    $sup_id=$_POST['sup_id'];
?>
	<div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Add Student</h3>
              </div>
              <div class="card-body">
				
				  <form action="#">
                  <div class="form-group">
                    <label for="email" >Matric Number</label>
                    <input type="text" name="username" id="number" class="form-control" placeholder="Enter Matric Number">
                  </div>
                  <div class="form-group">
                    <label for="email" >Name</label>
                    <input type="text" name="username" id="name" class="form-control" placeholder="Enter Matric Number">
                  </div>
                  <div class="form-group">
                    <label for="email" >Email</label>
                    <input type="email" name="username" id="email" class="form-control" placeholder="Enter Matric Number">
                  </div>
                  <div class="form-group">
                    <label for="email" >Phone Number</label>
                    <input type="email" name="username" id="phoneNumber" class="form-control" placeholder="Enter Matric Number">
                  </div>
                  <div class="form-group">
                    <label for="email" >Gender</label>
                    <select class="form-control" id="gender">
                        <option></option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="email" >Faculty</label>
                    <select class="form-control" id="faculty">
                        <option></option>
                        <?php
                           include_once('../includes/connection.php');
                          $sql_get=mysqli_query($con,"SELECT *FROM faculties");
                          if($sql_get){
                              $sql_getRow=mysqli_num_rows($sql_get);
                              if($sql_getRow > 0){
                                  while($data=mysqli_fetch_array($sql_get)){
                                  $faculty_title=$data['faculty_title'];
                                  $faculty_id=$data['faculty_id'];

                                    echo '<option value='.$faculty_id.'>'.$faculty_title.'</option>';
                                  }
                              }
                          }
                        ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="email" >Project Type</label>
                    <select class="form-control" id="type">
                        <option></option>
                        <option>Undergraduate Project</option>
                        <option>Masters Dissertation</option>
                        <option>PhD Project</option>
                        <option>PhD Thesis</option>
                    </select>
                  </div>
                 
				  <hr/>
				  <div id="errorr" style="color:red"></div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
			
			 <div class="modal-footer">
       
        <button onclick="addSupStudent(<?php echo $sup_id; ?>)" type="button" class="btn btn-success">Add Student</button>
      </div>