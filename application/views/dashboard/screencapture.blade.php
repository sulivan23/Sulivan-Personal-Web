@include('dashboard/v_header')
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>{{ $title }} - Application Image</title>
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
        <h1>Application : {{ $apps->application_name }} </h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href=" {{ base_url('dashboard') }} ">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Home</a></div>
            <div class="breadcrumb-item">Application Images</div>
        </div>
        </div>
        <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                  <a href="#add" class="btn btn-primary mb-4" id="add_data"><i class="fa fa-plus"></i> Add Image</a>
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                      <input type="hidden" class="form-control url" value="{{ base_url() }}" id="url">
                      <input type="hidden" class="form-control security_token" name="{{ $token_name }}" value="{{ $token }}">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Extension</th>
                            <th>Size</th>
                            <th>Created Date</th>
                            <th width="120">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($get_apps_img as $data)
                            <tr>
                                <td>{{ $data->application_img_id }}</td>
                                <td><img src=" {{ base_url("assets/img/application_img/". $data->value) }}" class="img-thumbnail" style="height:250px;width:300px;"></td>
                                <td>{{ $data->extension }}</td>
                                <td>{{ getSize($data->size) }}</td>
                                <td>{{ date('d F Y', strtotime($data->created_date)) }}</td>
                                <td>
                                    <a onclick="deleteData({{ $data->application_img_id }})" class="btn btn-danger text-white"><i class="fa fa-trash"></i></a>
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

    <form id="form_add" data="apps_img">
       <div class="form-group">
        <label>Image</label>
        <div class="input-group">
          <input type="hidden" value="<?= $apps->application_id ?>" name="apps_id">
          <input type="file" class="form-control" placeholder="Content..." name="files">
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
                        <button name="delete_apps_img" class="btn btn-primary modal-confirm_delete">Confirm</button>
                        <button class="btn btn-warning modal-dismiss">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('dashboard/v_footer')