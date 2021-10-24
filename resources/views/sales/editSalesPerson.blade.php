@extends('layouts.admin')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="container">
    <form method="PUT" action="{{ route('PersonUpdate') }}" id="formEdit">
        <div class="form-group row">
            <label for="id"  class="col-sm-2 col-form-label">ID</label>
            <div class="col-sm-10">
            <input  id="txt_id"  name="id" class="form-control" required readonly/>
            </div>
        </div>
        <div class="form-group row">
            <label for="name"  class="col-sm-2 col-form-label">Full Name</label>
            <div class="col-sm-10">
            <input name="name" id="txt_name" class="form-control" required />
            </div>
        </div>
        <div class="form-group row">
            <label for="email"  class="col-sm-2 col-form-label">Email Address</label>
            <div class="col-sm-10">
            <input name="email" id="txt_email" type="email" class="form-control" required/>
            </div>
        </div>
        <div class="form-group row">
            <label for="address"  class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10">
            <textarea name="address" id="txt_address" class="form-control"  required ></textarea>
            </div>
        </div>
        <div class="form-group  row">
            <label for="telephone"  class="col-sm-2 col-form-label">Telephone</label>
            <div class="col-sm-10">
            <input name="telephone" id="txt_telephone" type="number" class="form-control" required />
            </div>
        </div>
        <div class="form-group row">
            <label for="join_date"  class="col-sm-2 col-form-label">Join Date</label>
            <div class="col-sm-10">
            <input name="join_date" id="txt_date" type="date" class="form-control" required />
            </div>
        </div>

        <div class="form-group row">
            <label for="current_route"  class="col-sm-2 col-form-label">Current Routes</label>
            <div class="col-sm-10">
            <input name="current_route" id="txt_rooute" type="text" class="form-control" required />
            </div>
        </div>

        <div class="form-group row">
            <label for="comments"  class="col-sm-2 col-form-label">Comments</label>
            <textarea name="comments" id="txt_comment" class="form-control"  ></textarea>
        </div>
        @csrf
            <input type="submit" value="Save" class="btn btn-success btn-block" />

    </form>
</div>
<script>
    $('form').submit(function (e) {
            e.preventDefault();

            var form = $(this);
            var url = form.attr('action');
            console.log(form.serialize());

            $.ajax({
                type: "put",
                url: url,
                data: form.serialize(),
                dataType: "json",
                success: function (response) {
                    alert('Person record successfully updated!')
                }
            });
        });

    $(document).ready(function(){
        $.ajax({
            url: '/api/v1/person/view/'+<?= $id ?>,
            type: 'get',
            context: document.body,
            success: function(response){
                // Add response in Modal body
                $('#txt_id').val(response.data.id)
                $('#txt_name').val(response.data.name)
                $('#txt_email').val(response.data.email)
                $('#txt_address').html(response.data.address)
                $('#txt_telephone').val(response.data.telephone)
                $('#txt_date').val(response.data.join_date)
                $('#txt_rooute').val(response.data.current_route)
                $('#txt_comment').val(response.data.commets)

                // Display Modal
                $('#exampleModalCenter').modal('show');
            }
        });
    });
</script>
</body>
</html>
@endsection()
