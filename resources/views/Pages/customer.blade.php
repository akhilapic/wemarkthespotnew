@extends('layouts.admin')
@section('content')


<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h4 class="text-themecolor mb-0">User</h4>
		</div>
        <div class="col-md-7 col-12 align-self-center d-none d-md-block">
            <ol class="breadcrumb mb-0 p-0 bg-transparent fa-pull-right">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">User</li>
			</ol>
		</div>
	</div>
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
		<!-- basic table -->
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="border-bottom title-part-padding d-flex justify-content-between">
					    <h4 class="card-title mb-0">User List</h4> 
						<a style="display:none" href="{{ route('add_user') }}" class="btn btn-info btn-sm">
							Add User
						</a>               
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="zero_config" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Id.</th>
										<th>Name</th>
										<th><div style="width:100px;">Email</div></th>
										<th>DOB</th>
										<Th>Created Date (EST)</Th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								@foreach ($users as $user) 
								
									<tr>
										<td>{{ $user->id }}</td>
										<td style="display: table-cell;">
											<a href="javascript:void(0)" class="link">
												<img src="assets/admin/images/theme/user.png" alt="user" width="30" height="30" class="rounded-circle"> 
												<span class="ml-2">{{ $user->name }}</span>
											</a>
										</td>
										<td><div style="width:100px;">{{ $user->email }}</div></td>
										<td>{{ $user->dob }}</td>
												<td>{{ $user->created_at }}</td>
										<td>
											<div class="table_action">
												<a href="{{url('/user-view')}}/{{$user->id}}" class="btn btn-success btn-sm list_view infoU"  data-id='"{{ $user->id }}"' data-bs-whatever="@mdo">
													<i class="mdi mdi-eye"></i>
												</a>  
												<a href="{{ route('user_delete',$user->id) }}" class="btn deleteConf btn-danger btn-sm list_delete ">
													<i class="mdi mdi-delete"></i>
												</a> 
												
												<a style="display: none" href="{{ url('user_edit',$user->id) }}" class="btn btn-info btn-sm list_edit">
													<i class="mdi mdi-lead-pencil"></i>
												</a> 
												<span class="status">
													<label class="switch">
														@if($user->status==1)
														<input data-id="{{$user->id}}" class=" useractivedeactive switch-input" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $user->status ? 'checked' : '' }}>
														<span class="switch-label" data-on="Active" data-off="Deactive"></span> 
														<span class="switch-handle"></span> 
														@else
														<input data-id="{{$user->id}}" class=" useractivedeactive switch-input" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Deactive" data-off="InActive">
														<span class="switch-label" data-on="Deactive" data-off="Deactive"></span> 
														<span class="switch-handle"></span> 
														@endif
													</label>
												</span>
											</div>
											  
										</td>
									</tr>
									
									@endforeach
									<meta name="csrf-token" content="{{ csrf_token() }}">
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->


<!-- This page plugin CSS -->

<!-- Blog Details -->
<div class="modal fade" id="customer_details_modal" tabindex="-1" aria-labelledby="exampleModalLabel1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header d-flex align-items-center">
				<h4 class="modal-title" id="exampleModalLabel1">User Details</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<div class="modal-body">
				<div id="user-data">
					{{-- modal data here --}}
				</div>
			</div>

			<div class="modal-footer">
                <button type="button" class="btn btn-light-danger text-danger font-weight-medium" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade done_message" id="u_reject" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center">
                        <h4 class="modal-title" id="exampleModalLabel1">Message</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                        <form class=""  method="post" action="javascript:void(0)" id="user_deactive">
                            @csrf
                            <div class="mb-3 col-md-12">
                                <input type="hidden" id="user_id" name ="id"/>
                                <input type="hidden"  name ="status" id="status" value="0"/>
                                <label for="Name" class="control-label">Reason:</label>
                                <input type="text" required="true" id="reason" name="reason" class="form-control" id="recipient-name1">
                         
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-danger text-danger font-weight-medium" data-bs-dismiss="modal">Close</button>
                                    <button type="submit"  id="submit"  class="btn btn-success btn_submit">Ok</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@stop