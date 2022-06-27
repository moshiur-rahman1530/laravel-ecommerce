@extends('admin.layouts.app')
@section('title','Brands')
@section('content')
<div id="BrandMainDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 p-5">

    <div class="row">
      <div class="col-md-6"><h6 class="m-0 font-weight-bold text-primary float-left">Brand Lists</h6></div>
      <div class="col-md-6"> <button id="addNewBrand" class="btn btn-primary btn-sm font-weight-bold float-right"><i class="fas fa-plus"></i> Add New</button></div>
    </div>


      <table id="BrandDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
        	  <th class="th-sm">ID</th>
            <th class="th-sm">Name</th>
        	  <th class="th-sm">Desc</th>
        	  <th class="th-sm">Image</th>
            <th class="th-sm">Status</th>
        	  <th class="th-sm">Edit</th>
        	  <th class="th-sm">Delete</th>
          </tr>
        </thead>
        <tbody id="BrandTableBody">

        </tbody>
      </table>
    </div>
  </div>
</div>
<div id="loaderBrandDiv" class="container">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
    </div>
  </div>
</div>
<div id="WrongBrandDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <h3>Something Went Wrong !</h3>
    </div>
  </div>
</div>

<!-- modal for delete course -->
<div class="modal fade" id="deleteBrandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
         <h5 class="modal-title" id="deleteModalBrandId"> </h5>
       	<h5 class="modal-title">Are you sure to delete this category!!</h5>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">No</button>
        <button  id="BrandDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>


<!-- modal for adding Barnd -->
<div class="modal fade" id="addBrandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Barnd</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
            <input id="BrandNameId" type="text" id="" class="form-control mb-3" placeholder="Brand Name">
            <input id="BrandDesId" type="text" id="" class="form-control mb-3" placeholder="Brand Description">
      		 	<input id="BrandImage" type="text" id="" class="form-control mb-3" placeholder="Brand image url">

             <select id="BrandStatus" class="w-100 mb-3" style="height:36px" name="cat_id">
              <option value="">Select Status</option>
              <option value="1" >Active</option>
              <option value="0" >Inctive</option>
            </select>


       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
        <button  id="BrandAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- modal for updae status -->
<div class="modal fade" id="CatStatusUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
         <h5 class="modal-title" id="CatStatusBrandId"> </h5>
       	<h5 class="modal-title">Are you sure to delete this category!!</h5>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">No</button>
        <button  id="BrandStatusConfirmBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>



<!-- modal for update brands -->
<div class="modal fade" id="UpdateBrandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update Brand</h5>
        <h5 id="UpdateBrandId" class="d-none"> </h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div id="UpdateBrandLoader" class="container">
        <div class="row">
          <div class="col-md-12 text-center p-5">
            <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
          </div>
        </div>
      </div>

      <div id="WrongBrandUpdate" class="container d-none">
        <div class="row">
          <div class="col-md-12 text-center p-5">
            <h3>Something Went Wrong !</h3>
          </div>
        </div>
      </div>


      <div class="modal-body d-none text-center" id="updateBrandModalDNone">

       <div class="container">
         	<input id="UpdateBrandNameId" type="text" id="" class="form-control mb-3" placeholder="Brand Name">
      	 	<input id="UpdateBrandDesId" type="text" id="" class="form-control mb-3" placeholder="Brand Description">
     			<input id="UpdateBrandImgId" type="text" id="" class="form-control mb-3" placeholder="Brand Image">
           <select id="updateBrandStatus" class="w-100 mb-3" style="height:36px" name="cat_id">
              <option value="">Select Status</option>
              <option value="1" >Active</option>
              <option value="0" >Inctive</option>
            </select>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
        <button  id="BrandUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Update</button>
      </div>
    </div>
  </div>
</div>


@endsection
@section('script')
<script type="text/javascript">
getAllBrand();

function getAllBrand(){
  axios.get('/allbrands').then(function(response){

     if (response.status == 200) {
         $('#BrandMainDiv').removeClass('d-none');
         $('#loaderBrandDiv').addClass('d-none');

         $('#BrandDataTable').DataTable().destroy();
         $('#BrandTableBody').empty();

           var jsonData = response.data;
            $.each(jsonData, function(i, item){
                if (jsonData[i].status==1) {
                var status= 'Active';
                var finalStatus = "<a class='catStatusBtns btn btn-sm btn-success' data-id=" + jsonData[i].id + ">"+ status +"</a>"
                }else{
                  var status= 'Inactive';
                   var finalStatus = "<a class='catStatusBtns btn btn-sm btn-danger' data-id=" + jsonData[i].id + ">"+ status +"</a> "
                }
             $('<tr>').html(
                 "<td>"+jsonData[i].id+"</td>"+
                 "<td>"+jsonData[i].name+"</td>"+
                 "<td>"+jsonData[i].description+"</td>"+
                  "<td><img class='table-img' src=" + jsonData[i].img + "></td>"+
                   "<td>"+ finalStatus +"</td>" +
                 "<td><a  class='subcategoryEditBtn' data-id=" + jsonData[i].id + "><i class='fas fa-edit'></i></a></td>" +
                 "<td><a class='subcategoryDeleteBtn' data-id='" + jsonData[i].id + "'><i class='fas fa-trash-alt'></i></a></td>"
              ).appendTo('#BrandTableBody');
            });
              // show edit modal
            $('.subcategoryEditBtn').click(function(){
                $('#UpdateBrandModal').modal('show');
                var id = $(this).data('id');
                $('#UpdateBrandId').html(id);
                updateBrandDetails(id);
            });

              // show delete modal
            $('.subcategoryDeleteBtn').click(function(){
                $('#deleteBrandModal').modal('show');
                var id = $(this).data('id');
                $('#deleteModalBrandId').html(id);
            });

            // change status click
            $('.catStatusBtns').click(function(){
                var id = $(this).data('id');
                cnangeBrandStatus(id);
            });


       $('#BrandDataTable').DataTable({"order":false});
       $('.dataTables_length').addClass('bs-select');

     }else{
       $('#loaderBrandDiv').addClass('d-none');
        $('#WrongUpdate').removeClass('d-none');
     }

  }).catch(function(error){

    $('#loaderBrandDiv').addClass('d-none');
    $('#WrongBrandDiv').removeClass('d-none');
  });
}

// detais show in update exampleModalLabel
function updateBrandDetails(id){
  axios.post('/brandsDetails',{
    id:id
  }).then(function(response){
        if(response.status==200 && response.data){
            $('#updateBrandModalDNone').removeClass('d-none');
            $('#UpdateBrandLoader').addClass('d-none');
            var jsonData = response.data;
            $('#UpdateBrandNameId').val(jsonData[0].name);
            $('#UpdateBrandDesId').val(jsonData[0].description);
            $('#UpdateBrandImgId').val(jsonData[0].img);
            $('#updateBrandStatus').val(jsonData[0].status);
        } else{
          $('#UpdateBrandLoader').addClass('d-none');
          $('#WrongBrandUpdate').removeClass('d-none');
        }
  }).catch(function(error){
    $('#UpdateBrandLoader').addClass('d-none');
    $('#WrongBrandUpdate').removeClass('d-none');
  })
}

// update Brand

$('#BrandUpdateConfirmBtn').click(function(){
  var id = $('#UpdateBrandId').html();
  var name =  $('#UpdateBrandNameId').val();
  var description =  $('#UpdateBrandDesId').val();
  var img =  $('#UpdateBrandImgId').val();
  var status =  $('#updateBrandStatus').val();
   $('#BrandUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/updateBrand',{
    id:id,
    name:name,
    description:description,
    img:img,
    status:status,
  }).then(function(response){
          $('#BrandUpdateConfirmBtn').html("Save");
            if(response.status==200){
              if (response.data == 1) {
                $('#UpdateBrandModal').modal('hide');
                toastr.success('Update Barnd Success');
              getAllBrand();
            } else {
                $('#UpdateBrandModal').modal('hide');
                toastr.error('Update Barnd Fail');
              getAllBrand();
            }
          }
          else{
            $('#UpdateBrandModal').modal('hide');
             toastr.error('Something Went Wrong !');
          }
  }).catch(function(error){
    $('#UpdateBrandModal').modal('hide');
     toastr.error('Something Went Wrong !');
  })
})

// status update
function cnangeBrandStatus(id){
  axios.post('/brandsStatus',{
    id:id
  }).then(function(response){
    if (response.status==200) {
      if (response.data==1) {
        toastr.success('Brand Status Change!!');
        getAllBrand();
      } else {
        toastr.error('Brand Status Change fail!!');
        getAllBrand();
      }
    } else {
      toastr.error('Something Went Worng!!');
    }
  }).catch(function(error){
    toastr.error(error);
  })
}

$('#BrandStatusConfirmBtn').click(function(){
  var id = $('#CatStatusBrandId').html();
  $('#BrandStatusConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/brandsStatus',{
    id:id
  }).then(function(response){
    $('#BrandStatusConfirmBtn').html('Yes');
    if (response.status==200) {
      if (response.data==1) {
        $('#CatStatusUpdate').modal('hide');
        toastr.success('Brand delete successfully!!');
        getAllBrand();
      } else {
        $('#CatStatusUpdate').modal('hide');
        toastr.error('Brand delete fail!!');
        getAllBrand();
      }
    } else {
      $('#CatStatusUpdate').modal('hide');
      toastr.error('Something Went Worng!!');
    }
  }).catch(function(error){
    $('#CatStatusUpdate').modal('hide');
    toastr.error(error);
  })
})

// delete categoryDeleteBtn

$('#BrandDeleteConfirmBtn').click(function(){
  var id = $('#deleteModalBrandId').html();
  $('#BrandDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/brandsDelete',{
    id:id
  }).then(function(response){
    $('#BrandDeleteConfirmBtn').html('Yes');
    if (response.status==200) {
      if (response.data==1) {
        $('#deleteBrandModal').modal('hide');
        toastr.success('Brand delete successfully!!');
        getAllBrand();
      } else {
        $('#deleteBrandModal').modal('hide');
        toastr.error('Brand delete fail!!');
        getAllBrand();
      }
    } else {
      $('#deleteBrandModal').modal('hide');
      toastr.error('Something Went Worng!!');
    }

  }).catch(function(error){
    $('#deleteBrandModal').modal('hide');
    toastr.error('Something Went Worng!!');
  })
})

// add new category
$('#addNewBrand').click(function(){
  $('#addBrandModal').modal('show');
})

$('#BrandAddConfirmBtn').click(function(){
  var BrandName =$('#BrandNameId').val();
  var BrandDes =$('#BrandDesId').val();
  var BrandImg =$('#BrandImage').val();
  var status =$('#BrandStatus').val();
  addBrand(BrandName, BrandDes, BrandImg,status);
})
function addBrand(BrandName, BrandDes, BrandImg,status){
  $('#BrandAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/brands', {
    name: BrandName,
    description: BrandDes,
    img: BrandImg,
    status: status,
  }).then(function(response){
      $('#BrandAddConfirmBtn').html("Save");
      if(response.status==200){
              if (response.data == 1) {
                $('#addBrandModal').modal('hide');
                toastr.success('Add Success');
                getAllBrand();
            } else {
                $('#addBrandModal').modal('hide');
                toastr.error('Add Fail');
                getAllBrand();
            }
          }
  }).catch(function(error){
    $('#addBrandModal').modal('hide');
    toastr.error('Something Went Wromg');
  });
}


</script>
@endsection
