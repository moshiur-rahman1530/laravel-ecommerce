@extends('layouts.app2')

@section('content')

<!-- Page Header Start -->
  <div class="container-fluid bg-secondary mb-5">
      <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
          <h1 class="font-weight-semi-bold text-uppercase mb-3">Shopping Cart</h1>
          <div class="d-inline-flex">
              <p class="m-0"><a href="">Home</a></p>
              <p class="m-0 px-2">-</p>
              <p class="m-0">Shopping Cart</p>
          </div>
      </div>
  </div>
  <!-- Page Header End -->


  <!-- Cart Start -->
  <div class="container-fluid pt-5">
      <div class="row px-xl-5">
          <div class="col-lg-8 table-responsive mb-5">
              <table class="table table-bordered text-center mb-0">
                  <thead class="bg-secondary text-dark">
                      <tr>
                          <th></th>
                          <th>Products</th>
                          <th>Price</th>
                          <th>Quantity</th>
                          <th>Discount</th>
                          <th>Total</th>
                          <th>Remove</th>
                      </tr>
                  </thead>
                  <tbody class="align-middle" id="shippingTable">


                 
                    
                  </tbody>
              </table>
          </div>
          <div class="col-lg-4">
              <form class="mb-5" action="">
                  <div class="input-group">
                      <input type="text" class="form-control p-4" placeholder="Coupon Code">
                      <div class="input-group-append">
                          <button class="btn btn-primary">Apply Coupon</button>
                      </div>
                  </div>
              </form>
              <div class="card border-secondary mb-5">
                  <div class="card-header bg-secondary border-0">
                      <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                  </div>
                  <div class="card-body">
                      <div class="d-flex justify-content-between mb-3 pt-1">
                          <h6 class="font-weight-medium">Subtotal</h6>
                          <!-- <h6 class="font-weight-medium">$150</h6> -->
                          <h6 class="font-weight-medium">$<span id="getsubtotal"></span></h6>
                      </div>
                      <div class="d-flex justify-content-between align-items-center">
                          <h6 class="font-weight-medium">Shipping Cost</h6>
                          <!-- <h6 class="font-weight-medium">$<span id="shipping">10</span></h6> -->
                        <div class="shipping divst-none">
                            <select id="ShippingArea" class="w-100 mb-3" style="height:36px; border:none" name="shipping">
                                <option vlaue="0">Select Your Address</option>
                                @foreach($shipping as $address)
                                <option id="shippingValue" class="shippingValue" value="{{$address->id}}" data-price="{{$address->price}}" >{{$address->type}}:${{$address->price}}</option>
                                @endforeach
                          </select>
                        </div>
                         


                      </div>
                  </div>
                  <div class="card-footer border-secondary bg-transparent">
                      <div class="d-flex justify-content-between mt-2">
                          <h5 class="font-weight-bold">Total</h5>
                          <h5 class="font-weight-bold">$<span id="totalPrice"></span></h5>
                      </div>
                      <button id="checkout" class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</button>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Cart End -->


  <!-- modal start -->
  <!-- modal for delete course -->
    <div class="modal fade" id="deleteCartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body  text-center">
        <div class="container">
            <h5 class="modal-title" id="deleteModalCartId"> </h5>
            <h5 class="modal-title">Are you sure to delete this category!!</h5>
        </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
            <button  id="CartDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
        </div>
        </div>
    </div>
    </div>
  <!-- modal end -->

@endsection

@section('script')
<script type="text/javascript">

getAllCartProduct();

         

                // $(document).ready(function(){
			    // $('.shipping select[name=shipping]').change(function(){
				// let cost = parseFloat( $(this).find('option:selected').data('price') ) || 0;
				// var subP = parseFloat($('#getsubtotal').html());
				
                //         $('#totalPrice').text('$'+(subP + cost).toFixed(2));
                //     });

                // });

$('#checkout').click(function(){
   window.location = '/checkout'
})

function getAllCartProduct(){
    axios.get('/cartItems').then(function(response){

        if (response.status == 200) {
            $('#shippingTable').empty();

            var jsonData = response.data;

            if (jsonData.length<=0) {
                $('<tr>').html("<td colspan='7'><h2 class='m-5'>Your Cart is Empty</h2></td>").appendTo('#shippingTable');
            } 
            var totalSub = 0;
            // var total = 0;
            $.each(jsonData, function(i, item){
                    totalSub += ((jsonData[i].product_price*jsonData[i].qtn)-(jsonData[i].discount*jsonData[i].qtn));
                    // console.log(totalSub);
                        $('#getsubtotal').html(totalSub);
                         $('#totalPrice').html(totalSub);
                $('<tr>').html(
                    "<td><img style='width: 50px;' class='table-img' src=" + jsonData[i].image + "></td>"+
                    "<td class='align-middle'>"+jsonData[i].product_name+"</td>"+
                    "<td class='align-middle'>"+jsonData[i].product_price+"</td>"+


                    "<td class='align-middle'><div class='input-group quantity mx-auto' style='width: 100px;'><div class='input-group-btn'><button data-id="+jsonData[i].id+" class='btn btn-sm btn-primary btn-minus' ><i class='fa fa-minus'></i> </button></div><input type='text' class='form-control form-control-sm bg-secondary text-center qtnValue' value="+jsonData[i].qtn+"><div class='input-group-btn'><button data-id="+jsonData[i].id+" class='btn btn-sm btn-primary btn-plus'><i class='fa fa-plus'></i></button></div></div></td>"+

                    "<td class='align-middle'>"+jsonData[i].discount+"</td>"+
                
                    "<td class='align-middle'>" +((jsonData[i].product_price*jsonData[i].qtn)-(jsonData[i].discount*jsonData[i].qtn))+ "</td>"+
                    "<td class='align-middle'><button data-id="+jsonData[i].id+" class='deleteCartItem btn btn-sm btn-primary'><i class='fa fa-times'></i></button></td>"
                ).appendTo('#shippingTable');
            });


                        // var shipping = parseFloat($('#shippingValue').html());
                        // var subP = parseFloat($('#getsubtotal').html());
                        // console.log(shipping+subP);
                        // var total = subP + shipping ;
                        // $('#totalPrice').html(total);


                // delete cart product modal show
                $('.deleteCartItem').click(function(){
                    $('#deleteCartModal').modal('show');
                    var id = $(this).data('id');
                    $('#deleteModalCartId').html(id);
                });

                // product increase
                $('.btn-plus').on('click',function(){
                    var id = $(this).data('id');
                    // var catqtn = $('.qtnValue').val();
                    axios.post('/cartIncrement',{
                        id:id
                    }).then(function(response){
                        if (response.status==200) {
                            if (response.data==1) {
                                toastr.success('Update qtn');
                                getAllCartProduct();
                            }else if(response.data==2){
                                toastr.warning('You can buy 5 products at a time');
                            }else {
                                toastr.error('Update fail qtn');
                            }
                            
                        } else {
                            toastr.error('Not response');
                        }
                    }).catch(function(error){
                        toastr.error('something wrong');
                    })
                })

                // product Decrease
                $('.btn-minus').click(function(){
                    var id =$(this).data('id');
                    var catqtn = $('.qtnValue').val();
                    axios.post('/cartDecrement',{
                        id:id,
                        qtn:catqtn
                    }).then(function(response){
                        if (response.status==200) {
                            if (response.data==1) {
                                toastr.success('Update qtn');
                                getAllCartProduct();
                            } else if(response.data==2){
                                toastr.warning('Must select atleast 1 product');
                            }else {
                                toastr.error('Update fail qtn');
                            }
                        } else {
                            toastr.error('Not response');
                        }
                    }).catch(function(error){
                        toastr.error('something wrong');
                    })
                })

                $('.quantity button').on('click', function () {
                var button = $(this);
                var oldValue = button.parent().parent().find('input').val();
                if (button.hasClass('btn-plus')) {

                    if(oldValue<5){
                    var newVal = parseFloat(oldValue) + 1;
                    //   $('.btn-plus i').removeClass('fa-ban');
                    //   $('.btn-plus i').addClass('fa-plus');
                    //   $('.btn-minus i').removeClass('fa-ban');
                    //   $('.btn-minus i').addClass('fa-minus');
                    }else{
                    var newVal =5;
                    //   $('.btn-plus i').removeClass('fa-plus');
                    //   $('.btn-plus i').addClass('fa-ban');
                    //   $('.btn-minus i').removeClass('fa-ban');
                    //   $('.btn-minus i').addClass('fa-minus');
                    }
                } else {
                    if (oldValue > 1) {
                        var newVal = parseFloat(oldValue) - 1;
                        // $('.btn-plus i').removeClass('fa-ban');
                        // $('.btn-plus i').addClass('fa-plus');
                        // $('.btn-plus i').removeClass('fa-ban');
                        // $('.btn-plus i').addClass('fa-plus');
                    } else {
                        newVal = 1;
                        // $('.btn-plus i').removeClass('fa-ban');
                        // $('.btn-plus i').addClass('fa-plus');
                        // $('.btn-minus i').removeClass('fa-minus');
                        // $('.btn-minus i').addClass('fa-ban');
                    }
                }
                button.parent().parent().find('input').val(newVal);
            });

        }else{
            }

    }).catch(function(error){

    });

}


            $(document).ready(function(){
                $('.shipping select[name=shipping]').change(function(){
                        var shippingAmount = parseFloat($(this).find('option:selected').data('price'));
                    var subP = parseFloat($('#getsubtotal').html());
                    console.log(shippingAmount);
                    var total = subP + shippingAmount ;
                    $('#totalPrice').text(total);
                    
                })
            })



// delete cart item permanently

$('#CartDeleteConfirmBtn').click(function(){
  var id = $('#deleteModalCartId').html();
  $('#CartDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/cartDelete',{
    id:id
  }).then(function(response){
    $('#CartDeleteConfirmBtn').html('Yes');
    if (response.status==200) {
      if (response.data==1) {
        $('#deleteCartModal').modal('hide');
        toastr.success('Cart item remove successfully!!');
        getAllCartProduct();
        totalCountCart();
      } else {
        $('#deleteCartModal').modal('hide');
        toastr.error('Cart remove fail!!');
        getAllCartProduct();
      }
    } else {
      $('#deleteCartModal').modal('hide');
      toastr.error('Something Went Worng!!');
    }

  }).catch(function(error){
    $('#deleteCartModal').modal('hide');
    toastr.error('Something Went Worng!!');
  })
})



// $('.btn-plus').click(function(){
//     var pricedata = $('#priceId').html();
//     var quantity = $('#quantityId').val();
//     var sub = pricedata*quantity;
//     $('#subTotal').html(sub);
//     console.log(pricedata);
// })

// totalPrice();
//         function totalPrice(){
//             var unitprice = $('.priceId').html();
//             console.log(unitprice);
//             var unitQuantity = $('.quantityId').val();
//             var totalPrice = unitprice*unitQuantity;
//              $(".subTotal").html("<p>"+totalPrice+"</p>");
//         }

    </script>
@endsection
