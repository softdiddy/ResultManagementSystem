<?php
    $level=$_POST['level'];
    $programme=md5($_POST['programme']);
    $session=md5($_POST['session']);
?>
<div class="card" style="top:10px;" id="loadUpload">
              <div class="card-header">
                <h5 class="card-title">Student Upload</h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="width:100%">
                    <div class="row" style="background-color:#ccc;border-radius:10px;width:100%;text-align:center;">
                    <div class="upload-btn-wrapper">
                    <i class="fas fa-download" style="font-size:20px;"></i><hr/>
  <a href="upload_result_wiz/upload_students.php?sss=<?php echo $session."&l=".$level,"&pr=".$programme; ?>" target="_blank" class="btn2">Upload a file</a>
  
</div>
                    </div>
                </div>
</div>

<style>
  .upload-btn-wrapper {
  position: relative;
  overflow: hidden;
  display: inline-block;
  cursor: pointer;
  margin:30%;
}

.btn2 {
  border: 2px solid gray;
  color: gray;
  background-color: white;
  padding: 8px 20px;
  border-radius: 8px;
  font-size: 20px;
  font-weight: bold;
  cursor: pointer;
  margin: 0px;
}

.upload-btn-wrapper input[type=file] {
  font-size: 100px;
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;
  cursor: pointer;
}
</style>