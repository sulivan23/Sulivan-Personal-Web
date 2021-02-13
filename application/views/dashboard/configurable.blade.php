@include('dashboard/v_header')
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>{{ $title }} - Configurable</title>
       <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ base_url() }}dashboard_assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ base_url() }}dashboard_assets/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css">
      <!-- CSS Libraries -->

      <!-- Template CSS -->
    <link rel="stylesheet" href="{{ base_url() }}dashboard_assets/assets/css/style.css">
 </head> 
    <!-- Main Content -->
    <div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>Configurable Data</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Home</a></div>
            <div class="breadcrumb-item">Configurable</div>
        </div>
        </div>
        <div class="section-body">
            <div class="row">
              <div class="col-12">
              <div class="alert alert-light alert-error" style="display:none"></div>
                <div class="card">
                  <div class="card-body">
                  <a href="#add" class="btn btn-primary mb-4" id="add_data"><i class="fa fa-plus"></i> Add Configurable</a>
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                      <input type="hidden" class="form-control url" value="{{ base_url() }}" id="url">
                      <input type="hidden" class="form-control security_token" name="{{ $token_name }}" value="{{ $token }}">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Value</th>
                            <th>Description</th>
                            <th>Content</th>
                            <th width="100">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($get_configurable as $data)
                            <tr>
                                <td>{{ $data->data_id }}</td>
                                <td>{{ $data->value }}</td>
                                <td>{{ $data->description }}</td>
                                <td>{{ $data->content }}</td>
                                <td>
                                    <a onclick="popUpUpdate({{ $data->data_id }}, 'conf');" class="btn btn-primary text-white"><i class="fa fa-edit"></i></a>
                                    <a onclick="deleteData({{ $data->data_id }})" class="btn btn-danger text-white"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
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

    <form id="form_add" data="configurable">
      <div class="form-group">
        <label>Value</label>
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Value..." name="value">
        </div>
      </div>
      <div class="form-group">
        <label>Description</label>
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Description..." name="description">
        </div>
      </div>
      <div class="form-group">
        <label>Content</label>
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Content..." name="content">
          <input type="hidden" class="form-control security_token" name="{{ $token_name }}" value="{{ $token }}">
        </div>
      </div>
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
							<button name="delete_conf" class="btn btn-primary modal-confirm_delete">Confirm</button>
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
					<form id="update_conf" class="form-horizontal mb-lg">
          <div class="form-group">
            <label>Value</label>
            <div class="input-group">
              <input type="text" class="form-control value" placeholder="Value..." name="value">
            </div>
          </div>
          <div class="form-group">
            <label>Description</label>
            <div class="input-group">
              <input type="text" class="form-control desc" placeholder="Description..." name="description">
            </div>
          </div>
          <div class="form-group">
            <label>Content</label>
            <div class="input-group">
              <input type="text" class="form-control content" placeholder="Content..." name="content">
            </div>
          </div>
          <input type="hidden" class="form-control security_token" name="{{ $token_name }}" value="{{ $token }}">
					</form>
        </div>
        <div class="card-footer">
					<div class="row">
						<div class="col-md-12 text-right">
							<button class="btn btn-primary modal-update" name="update_conf">Update</button>
							<button class="btn btn-warning modal-dismiss">Cancel</button>
						</div>
					</div>
        </div>
      </div>
    </div>
@include('dashboard/v_footer')