<?php
  use App\Models\Product;
?>
@extends('admin.layouts.app')
@section('title','Category')
@section('content')
<div id="CategoryMainDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 p-5">

    <div class="row">
      <div class="col-md-6"><h6 class="m-0 font-weight-bold text-primary float-left">Category Lists</h6></div>
      <div class="col-md-6"> <button id="addNewCategory" class="btn btn-primary btn-sm font-weight-bold float-right"><i class="fas fa-plus"></i> Add New</button></div>
    </div>

     
      <table id="CategoryDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
        	  <th class="th-sm">ID</th>
            <th class="th-sm">Name</th>
        	  <th class="th-sm">Desc</th>
        	  <!-- <th class="th-sm">Total Product</th> -->
            <th class="th-sm">Image</th>
            <th class="th-sm">Status</th>
        	  <th class="th-sm">Edit</th>
        	  <th class="th-sm">Delete</th>
          </tr>
        </thead>
        <tbody id="CategoryTableBody">


            <!-- @foreach($category as $cat)
              @php
                $productCategoryCount = App\Models\Product::CountCategory($cat->id)
              @endphp
              <p id="catUnderProduct" class="catUnderProduct">{{$productCategoryCount}}</p>
            @endforeach -->

        </tbody>
      </table>
    </div>
  </div>
</div>
<div id="loaderCategoryDiv" class="container">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
    </div>
  </div>
</div>
<div id="WrongCategoryDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <h3>Something Went Wrong !</h3>
    </div>
  </div>
</div>

<!-- modal for delete course -->
<div class="modal fade" id="deleteCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
         <h5 class="modal-title" id="deleteModalCategoryId"> </h5>
       	<h5 class="modal-title">Are you sure to delete this category!!</h5>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">No</button>
        <button  id="CategoryDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>



<!-- modal for update course -->
<div class="modal fade" id="UpdateCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update Course</h5>
        <h5 id="UpdateCourseId"> </h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div id="UpdateLoader" class="container">
        <div class="row">
          <div class="col-md-12 text-center p-5">
            <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
          </div>
        </div>
      </div>

      <div id="WrongUpdate" class="container d-none">
        <div class="row">
          <div class="col-md-12 text-center p-5">
            <h3>Something Went Wrong !</h3>
          </div>
        </div>
      </div>


      <div class="modal-body d-none text-center" id="updateModalDNone">

       <div class="container">
       	<div class="row">
       		<div class="col-md-6">
             	<input id="UpdateCourseNameId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="UpdateCourseDesId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
    		 	<input id="UpdateCourseFeeId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
     			<input id="UpdateCourseEnrollId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="UpdateCourseClassId" type="text" id="" class="form-control mb-3" placeholder="Total Class">
     			<input id="UpdateCourseLinkId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
     			<input id="UpdateCourseImgId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
        <button  id="CourseUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Update</button>
      </div>
    </div>
  </div>
</div>


<!-- modal for adding category -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Category</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
            <input id="CategoryNameId" type="text" id="" class="form-control mb-3" placeholder="Category Name">
            <input id="CategoryDesId" type="text" id="" class="form-control mb-3" placeholder="Category Description">
            <!-- <textarea name="CategoryDesId" id="CategoryDesId" cols="30" class="form-control mb-3" rows="10" placeholder="Category Description"></textarea> -->
      		 	<input id="CategoryImage" type="text" id="" class="form-control mb-3" placeholder="Category image url">
                <select name="status" id="catStatus" class="catStatus form-control">
                    <option>Status Select</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cancel</button>
        <button  id="CategoryAddConfirmBtn" type="button" class="btn btn-sm btn-danger">Save</button>
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
         <h5 class="modal-title" id="CatStatusCategoryId"> </h5>
       	<h5 class="modal-title">Are you sure to delete this category!!</h5>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">No</button>
        <button  id="CatStatusConfirmBtn" type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>


@endsection
@section('script')
<script type="text/javascript">
getAllCategory();

function getAllCategory(){
  axios.get('/allcategory').then(function(response){

     if (response.status == 200) {
         $('#CategoryMainDiv').removeClass('d-none');
         $('#loaderCategoryDiv').addClass('d-none');

         $('#CategoryDataTable').DataTable().destroy();
         $('#CategoryTableBody').empty();

           var jsonData = response.data;
            $.each(jsonData, function(i, item){
              // var catPro = $('.catUnderProduct').html();
              // console.log(catPro);
                if (jsonData[i].status==1) {
                var status= 'Active';
                var finalStatus = "<a class='catStatusBtns btn btn-sm btn-success' data-id=" + jsonData[i].id + ">"+ status +"</a>"
                }else{
                  var status= 'Inactive';
                   var finalStatus = "<a class='catStatusBtns btn btn-sm btn-danger' data-id=" + jsonData[i].id + ">"+ status +"</a> "
                }
             $('<tr>').html(
                 "<td>"+jsonData[i].id+"</td>"+
                 "<td>"+jsonData[i].cat_name+"</td>"+
                 "<td>"+jsonData[i].cat_des+"</td>"+
                 // "<td class='catproduct'></td>"+
                  "<td><img class='table-img' src=" + jsonData[i].cat_img + "></td>"+
                   "<td>"+ finalStatus +"</td>" +
                    // "<td><a class='catStatusBtns' data-id='" + jsonData[i].id + "'><i class='fas fa-edit'></i></a></td>" +

                   // "<td><input type='button' value='"+status+"' class='catStatusBtns btn btn-sm btn-info' data-id='"+jsonData[i].id+"' ></td>" +


                 "<td><a  class='serviceEditBtn' data-id=" + jsonData[i].id + "><i class='fas fa-edit'></i></a></td>" +
                 // "<td><a  class='categoryDeleteBtn'  data-id=" + jsonData[i].id +" ><i class='fas fa-trash-alt'></i></a></td>"
                 "<td><a class='categoryDeleteBtn' data-id='" + jsonData[i].id + "'><i class='fas fa-trash-alt'></i></a></td>"
              ).appendTo('#CategoryTableBody');
            });

            $('.categoryDeleteBtn').click(function(){
                $('#deleteCategoryModal').modal('show');
                var id = $(this).data('id');
                $('#deleteModalCategoryId').html(id);
            });

            $('.catStatusBtns').click(function(){
                $('#CatStatusUpdate').modal('show');
                var id = $(this).data('id');
                $('#CatStatusCategoryId').html(id);
            });


       $('#CategoryDataTable').DataTable({"order":false});
       $('.dataTables_length').addClass('bs-select');

     }else{
       $('#loaderCategoryDiv').addClass('d-none');
        $('#WrongUpdate').removeClass('d-none');
     }

  }).catch(function(error){

    $('#loaderCategoryDiv').addClass('d-none');
    $('#WrongCategoryDiv').removeClass('d-none');
  });
}

// status update


$('#CatStatusConfirmBtn').click(function(){
  var id = $('#CatStatusCategoryId').html();
  $('#CatStatusConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/categoryStatus',{
    id:id
  }).then(function(response){
    $('#CatStatusConfirmBtn').html('Yes');
    if (response.status==200) {
      if (response.data==1) {
        $('#CatStatusUpdate').modal('hide');
        toastr.success('Category delete successfully!!');
        getAllCategory();
      } else {
        $('#CatStatusUpdate').modal('hide');
        toastr.error('Category delete fail!!');
        getAllCategory();
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

$('#CategoryDeleteConfirmBtn').click(function(){
  var id = $('#deleteModalCategoryId').html();
  $('#CategoryDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/categoryDelete',{
    id:id
  }).then(function(response){
    $('#CategoryDeleteConfirmBtn').html('Yes');
    if (response.status==200) {
      if (response.data==1) {
        $('#deleteCategoryModal').modal('hide');
        toastr.success('Category delete successfully!!');
        getAllCategory();
      } else {
        $('#deleteCategoryModal').modal('hide');
        toastr.error('Category delete fail!!');
        getAllCategory();
      }
    } else {
      $('#deleteCategoryModal').modal('hide');
      toastr.error('Something Went Worng!!');
    }

  }).catch(function(error){
    $('#deleteCategoryModal').modal('hide');
    toastr.error('Something Went Worng!!');
  })
})

// add new category
$('#addNewCategory').click(function(){
  $('#addCategoryModal').modal('show');
})

$('#CategoryAddConfirmBtn').click(function(){
  var catName =$('#CategoryNameId').val();
  var catDes =$('#CategoryDesId').val();
  var catImg =$('#CategoryImage').val();
  var status =$('#catStatus').val();
  addCategory(catName, catDes, catImg,status);
})
function addCategory(catName, catDes, catImg,status){
  $('#CategoryAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/category', {
    catName: catName,
    catDes: catDes,
    catImg: catImg,
    status: status,
  }).then(function(response){
      $('#CategoryAddConfirmBtn').html("Save");
      if(response.status==200){
              if (response.data == 1) {
                $('#addCategoryModal').modal('hide');
                toastr.success('Add Success');
                getAllCategory();
            } else {
                $('#addCategoryModal').modal('hide');
                toastr.error('Add Fail');
                getAllCategory();
            }
          }
  }).catch(function(error){
    $('#addCategoryModal').modal('hide');
    toastr.error('Something Went Wromg');
  });
}


</script>
@endsection
