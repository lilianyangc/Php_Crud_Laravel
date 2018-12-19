<?php

function deleteModal($delete_id, $modalId){
?>
<!-- Modal -->
<div class="modal fade" id="<?php echo $modalId;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this record?

            </div>
            <div class="modal-footer">
                <form method="POST" action="delete/<?php echo $delete_id; ?>" >
                    @csrf
                    <input type="hidden" name="id" value="<?php echo $delete_id; ?>">
                    <button type="submit" name="delete" class="btn btn-primary" value="Delete">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </form>


            </div>
        </div>
    </div>
</div>
<?php

}
?>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <div class="jumbotron jumbotron-fluid">
                            <div class="container">
                                <h1 class="display-4">CRUD</h1>
                                <p class="lead">File Manipulation<br>List of Energy Property Tax Credit<br>of Student Residences</p>
                            </div>
                        </div>
                        <div>
                            <form class="form-inline my-2 my-lg-0 float-right" action="{{URL::to('/search')}}" method="POST" role="search">
                                @csrf
                                <input name="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" value="">
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                            </form>
                        </div>
                        <br>
                        <br>

                    <!-- View All Table data -->
                        <table class="table table-sm table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Institution</th>
                                <th>Student Residence</th>
                                <th>Street Number and Name</th>
                                <th>City</th>
                                <th>Province</th>
                                <th>Postal Code</th>
                                @guest
                                @else<th>Action</th> @endguest
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($institutions as $row)
                                <tr>
                                    <td>{{$row->id}}</td>
                                    <td>{{$row->institution_name}}</td>
                                    <td>{{$row->student_residence}}</td>
                                    <td>{{$row->street_number}}</td>
                                    <td>{{$row->city}}</td>
                                    <td>{{$row->province}}</td>
                                    <td>{{$row->postal_code}}</td>
                                    @guest
                                    @else
                                    <td>
                                        <a href="{{URL::to('/modify/'.$row->id)}}" >Edit</a>&nbsp;

                                        <button type="button" class="btn btn-primary"
                                                data-toggle="modal" data-target="#{{'delete-'.$row->id}}">
                                            Delete
                                        </button>
                                        @php deleteModal($row->id, 'delete-'.$row->id); @endphp
                                    </td>
                                    @endguest
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        {{ $institutions ->links() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
