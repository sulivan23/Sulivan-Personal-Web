@include('dashboard/v_header')
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>{{ $title }} - Internship</title>
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
        <h1>Internship</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href=" {{ base_url('dashboard') }} ">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Home</a></div>
            <div class="breadcrumb-item">Internship</div>
        </div>
        </div>
        <div class="section-body">
            <div class="row">
              <div class="col-12">
              <div class="alert alert-light alert-error" style="display:none"></div>
                <div class="card">
                  <div class="card-body">
                  <a href="#add" class="btn btn-primary mb-4" id="add_data"><i class="fa fa-plus"></i> Add Internship</a>
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                      <input type="hidden" class="form-control url" value="{{ base_url() }}" id="url">
                      <input type="hidden" class="form-control security_token" name="{{ $token_name }}" value="{{ $token }}">
                        <thead>
                          <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Company</th>
                            <th>Start Date</th>
                            <th>Finish Date</th>
                            <th>Desc</th>
                            <th>Position</th>
                            <th>Date Time</th>
                            <th width="120">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($get_intern as $data)
                            <tr>
                                <td><input type="radio" id="radioButton" name="radio" value="{{ $data->internship_id }}"></td>
                                <td>{{ $data->internship_id }}</td>
                                <td>{{ $data->company }}</td>
                                <td>{{ $data->start_year }}</td>
                                <td>{{ $data->finish_year }}</td>
                                <td>{{ $data->description }}</td>
                                <td>{{ $data->internship_position }}</td>
                                <td>{{ date('d F Y', strtotime($data->date_time)) }}</td>
                                <td>
                                    <a onclick="popUpUpdate({{ $data->internship_id }}, 'intern');" class="btn btn-primary text-white"><i class="fa fa-edit"></i></a>
                                    <a onclick="deleteData({{ $data->internship_id }}, 'intern')" class="btn btn-danger text-white"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                  <a href="#add" class="btn btn-primary mb-4" id="add_detail"><i class="fa fa-plus"></i> Add Detail Internship</a>
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-2">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Job Desc</th>
                            <th>Date Time</th>
                            <th width="120">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                    </div>
                  </div>
            </div>
        </div>
    </section>
    </div>

    <!-- Add data internship -->
    <form id="form_add" data="intern">
      <div class="form-group">
        <label>Company</label>
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Company..." name="company">
        </div>
      </div>
      <div class="form-group">
        <label>Start Date</label>
        <div class="input-group">
          <input type="date" class="form-control" name="start_date">
        </div>
      </div>
      <div class="form-group">
        <label>Finish Date</label>
        <div class="input-group">
          <input type="date" class="form-control" name="finish_date">
        </div>
      </div>
       <div class="form-group">
        <label>Description</label>
        <div class="input-group">
          <textarea class="form-control" placeholder="Description..." name="description"></textarea>
        </div>
      </div>
       <div class="form-group">
        <label>Internship Position</label>
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Content..." name="internship_position">
          <input type="hidden" class="form-control security_token" name="{{ $token_name }}" value="{{ $token }}">
        </div>
      </div>
    </form>

    <!-- Add detail data internship -->
    <form class="form2" id="form_detail" data="intern_detail">
      <div class="form-group">
        <label>Job Description</label>
        <div class="input-group">
          <input type="hidden" name="internship_id" value="">
          <input type="text" class="form-control" placeholder="Job Description..." name="job_desc">
          <input type="hidden" class="form-control security_token" name="{{ $token_name }}" value="{{ $token }}">
        </div>
      </div>
    </form>

    <!-- delete data internship detail-->
    <div id="deleteDetail" class="modal-block modal-block-primary mfp-hide">
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
							<button name="delete_intern_detail" class="btn btn-primary modal-confirm_delete">Confirm</button>
							<button class="btn btn-warning modal-dismiss">Cancel</button>
						</div>
					</div>
				</div>
			</div>
		</div>

    <!-- delete data internship-->
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
							<button name="delete_intern" class="btn btn-primary modal-confirm_delete">Confirm</button>
							<button class="btn btn-warning modal-dismiss">Cancel</button>
						</div>
					</div>
				</div>
			</div>
		</div>

    <!-- Edit data internship -->
    <div id="editForm" class="modal-block modal-block-primary mfp-hide">
			<div class="card">
				<div class="card-header bg-primary"><h4 class="text-white">Update Data</h4></div>
				<div class="card-body">
					<div class="edit_data alert" style="display:none"></div>
					<form id="update_intern" class="form-horizontal mb-lg">
          <div class="form-group">
            <label>Company</label>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Company..." name="company">
            </div>
          </div>
          <div class="form-group">
            <label>Start Date</label>
            <div class="input-group">
              <input type="date" class="form-control" name="start_date">
            </div>
          </div>
          <div class="form-group">
            <label>Finish Date</label>
            <div class="input-group">
              <input type="date" class="form-control" name="finish_date">
            </div>
          </div>
          <div class="form-group">
            <label>Description</label>
            <div class="input-group">
              <textarea class="form-control" placeholder="Description..." name="description" style="height:100px;"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label>Internship Position</label>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Internship position..." name="internship_position">
            </div>
          </div>
          <input type="hidden" class="form-control security_token" name="{{ $token_name }}" value="{{ $token }}">
					</form>
        </div>
        <div class="card-footer">
					<div class="row">
						<div class="col-md-12 text-right">
							<button class="btn btn-primary modal-update" name="update_intern">Update</button>
							<button class="btn btn-warning modal-dismiss">Cancel</button>
						</div>
					</div>
        </div>
      </div>
    </div>

  
    <!-- Edit data detail internship -->
    <div id="editForm2" class="modal-block modal-block-primary mfp-hide">
			<div class="card">
				<div class="card-header bg-primary"><h4 class="text-white">Update Data</h4></div>
				<div class="card-body">
					<div class="edit_data alert" style="display:none"></div>
					<form id="update_intern_detail" class="form-horizontal mb-lg">
          <div class="form-group">
            <label>Job Description</label>
            <div class="input-group">
              <textarea class="form-control" placeholder="Job Description..." name="job_desc" style="height:150px;"></textarea>
            </div>
          </div>
          <input type="hidden" class="form-control security_token" name="{{ $token_name }}" value="{{ $token }}">
					</form>
        </div>
        <div class="card-footer">
					<div class="row">
						<div class="col-md-12 text-right">
							<button class="btn btn-primary modal-update" name="update_intern_detail">Update</button>
							<button class="btn btn-warning modal-dismiss">Cancel</button>
						</div>
					</div>
        </div>
      </div>
    </div>
@include('dashboard/v_footer')