  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
			<div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">New Category</h3>
              </div>
              <div class="card-body">
				
				<div class="form-group">
                    <label for="exampleInputEmail1">Category Name</label>
                    <input class="form-control form-control-sm" type="text" placeholder="Category Name" id="Manufacturer Name">
                  </div>
				  
		
				  <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
					<textarea class="form-control form-control-sm" id="description"></textarea>
                  </div>
				  
				  <div id="error"></div>
              </div>
              <!-- /.card-body -->
            </div>
      </div>
      <div class="modal-footer">
        <button onclick="close_new_drugs()" type="button" class="btn btn-default" >Close</button>
        <button  type="button" class="btn btn-primary">Add</button>
      </div>
    </div>
  </div>