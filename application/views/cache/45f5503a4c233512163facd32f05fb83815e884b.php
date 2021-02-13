<?php echo $__env->make('dashboard/v_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title><?php echo e($title); ?> - Apps</title>
       <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?php echo e(base_url()); ?>dashboard_assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo e(base_url()); ?>dashboard_assets/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css">
      <!-- CSS Libraries -->

      <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo e(base_url()); ?>dashboard_assets/assets/css/style.css">
 </head> 
    <!-- Main Content -->
    <div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>Application</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo e(base_url('dashboard')); ?>">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Home</a></div>
            <div class="breadcrumb-item">Apps</div>
        </div>
        </div>
        <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                  <a href="#add" class="btn btn-primary mb-4" id="add_data"><i class="fa fa-plus"></i> Add Application</a>
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                      <input type="hidden" class="form-control url" value="<?php echo e(base_url()); ?>" id="url">
                      <input type="hidden" class="form-control security_token" name="<?php echo e($token_name); ?>" value="<?php echo e($token); ?>">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Application Name</th>
                            <th>Walpaper</th>
                            <th>Project Date</th>
                            <th>Type</th>
                            <th>Date Time</th>
                            <th width="150">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $get_apps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($data->application_id); ?></td>
                                <td><?php echo e($data->application_name); ?></td>
                                <td><img src="<?php echo e(base_url("assets/img/portfolio/"). $data->walpaper); ?>" style="height:200px;width:200px;" class="img-fluid"></td>
                                <td><?php echo e($data->project_date); ?></td>
                                <td><?php echo e($data->type); ?></td>
                                <td><?php echo e($data->date_time); ?></td>
                                <td>
                                    <a onclick="popUpUpdate(<?php echo e($data->application_id); ?>, 'apps');" class="btn btn-primary text-white"><i class="fa fa-edit"></i></a>
                                    <a onclick="deleteData(<?php echo e($data->application_id); ?>)" class="btn btn-danger text-white"><i class="fa fa-trash"></i></a>
                                    <a href=" <?php echo e(base_url('dashboard/images/'. $data->application_id). '/'. $data->application_name); ?> " class="btn btn-warning text-white"><i class="fa fa-image"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </section>
    </div>

    <form data="apps" id="form_add">
      <div class="form-group">
        <label>Application Name</label>
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Value..." name="app_name">
        </div>
      </div>
      <div class="form-group">
        <label>Walpaper</label>
        <div class="input-group">
          <input type="file" class="form-control" placeholder="Description..." name="files">
        </div>
      </div>
      <div class="form-group">
        <label>Description</label>
        <div class="input-group">
          <textarea class="form-control" placeholder="Content..." name="description" style="height:100px;"></textarea>
        </div>
      </div>
      <div class="form-group">
        <label>Requirement</label>
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Content..." name="requirement">
        </div>
      </div>
      <div class="form-group">
        <label>Category</label>
        <div class="input-group">
          <select class="form-control" name="category">
            <option>Web Development</option>
            <option>Web Design</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label>URL</label>
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Content..." name="url">
        </div>
      </div>
      <div class="form-group">
        <label>Client</label>
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Client..." name="client">
        </div>
      </div>
      <div class="form-group">
        <label>Project Date</label>
        <div class="input-group">
          <input type="date" class="form-control" name="project_date">
        </div>
      </div>
      <div class="form-group">
        <label>Type</label>
          <select class="form-control" name="type">
            <option>Public</option>
            <option>Private</option>
          </select>
      </div>
      <input type="hidden" class="form-control security_token" name="<?php echo e($token_name); ?>" value="<?php echo e($token); ?>">
    </form>

    <div id="deleteData" class="modal-block modal-block-primary mfp-hide">
			<div class="card">
				<div class="card-body text-center">
					<div class="modal-wrapper">
						<div class="modal-icon center">
							<i class="fa fa-question-circle"></i>
						</div>
						<div class="modal-text">
							<h4>Are you sure?</h4>
							<p></p>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<div class="row">
						<div class="col-md-12 text-right">
							<button name="delete_apps" class="btn btn-primary modal-confirm_delete">Confirm</button>
							<button class="btn btn-warning modal-dismiss">Cancel</button>
						</div>
					</div>
				</div>
			</div>
		</div>

    <div id="editForm" class="modal-block modal-block-primary mfp-hide">
			<div class="card">
				<div class="card-header bg-primary"><h4 class="text-white">Update Data</h4></div>
				<div class="card-body">
					<div class="edit_data alert" style="display:none"></div>
					<form id="update_apps" class="form-horizontal mb-lg">
          <div class="form-group">
            <label>Application Name</label>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Value..." name="application_name">
            </div>
          </div>
          <div class="form-group">
            <label>Walpaper</label>
            <img style="width:100%; height:350px;" class="img-fluid walpaper">
            <div class="input-group">
              <input type="file" class="form-control" placeholder="Description..." name="files">
            </div>
          </div>
          <div class="form-group">
            <label>Description</label>
            <div class="input-group">
              <textarea type="text" class="form-control" placeholder="Content..." name="description" style="height:100px;"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label>Requirement</label>
            <div class="input-group">
              <textarea type="text" class="form-control" placeholder="Requirement..." name="requirement" style="height:100px;"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label>Category</label>
            <div class="input-group">
              <select class="form-control" name="category">
                <option>Web Development</option>
                <option>Web Design</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label>URL</label>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Content..." name="url">
            </div>
          </div>
          <div class="form-group">
            <label>Client</label>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Client..." name="client">
            </div>
          </div>
          <div class="form-group">
            <label>Project Date</label>
            <div class="input-group">
              <input type="date" class="form-control" name="project_date">
            </div>
          </div>
          <div class="form-group">
            <label>Type</label>
              <select class="form-control" name="type">
                <option>Public</option>
                <option>Private</option>
              </select>
          </div>
          <input type="hidden" class="form-control security_token" name="<?php echo e($token_name); ?>" value="<?php echo e($token); ?>">
					</form>
        </div>
        <div class="card-footer">
					<div class="row">
						<div class="col-md-12 text-right">
							<button class="btn btn-primary modal-update" name="update_apps">Update</button>
							<button class="btn btn-warning modal-dismiss">Cancel</button>
						</div>
					</div>
        </div>
      </div>
    </div>
<?php echo $__env->make('dashboard/v_footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/akukamu/application/views/dashboard/my_apps.blade.php ENDPATH**/ ?>