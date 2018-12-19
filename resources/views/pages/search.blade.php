<?php
/**
 * Created by PhpStorm.
 * User: Lilian
 * Date: 2018-11-17
 * Time: 3:09 PM
 */

function requestValue($name, $default=''){

    return isset($_REQUEST[$name]) ? $_REQUEST[$name]: $default;

}
$count = 0;
$search = requestValue('search', '');
//A bootstrap 4 modal for delete function
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

    <br /><br />
    <h1> Search a record:</h1><br>

    <p>Enter any keyword for the search. Except entry Id</p>
    <form method="post" action="{{URL::to('/search')}}" role="search">
        @csrf
        <input type="text" name="search" placeholder="..." value="<?php echo $search; ?>">
        <input type="submit" name="submit">
    </form>

    @php
    if(isset($details)){

        if(count($details) == 0){
            $count =0;
        }else{
            $count = count($details);
        }
    }


    @endphp


    @php echo "<br><p> Total no. of entries found: " . $count."</p>"; @endphp

@if(isset($details))
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
            @else<th>Action</th>@endguest
        </tr>
        </thead>
        <tbody>

        @foreach($details as $row)
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

    @endif
    <br><br><br><a href="{{route('home')}}" class="btn btn-primary">Back to index page</a>
@endsection
