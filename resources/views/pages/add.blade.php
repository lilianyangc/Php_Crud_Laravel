<?php
/**
 * Created by PhpStorm.
 * User: Lilian
 * Date: 2018-11-17
 * Time: 2:16 PM
 */

?>
@extends('layouts.app')

@section('content')
<br><br>

<h1 class="display-4"> Create a new record:</h1>
<br><br>
<form method="POST" class="offset-md-3 col-md-6">
    @csrf
    <div class="form-group row">
        <label for="Institution" class="text-justify col-md-4 col-form-label">Institution</label>
        <div class="col-md-8">
            <input type="text" name="institution" class="form-control" id="Institution" value="" placeholder="" required/>
        </div>
    </div>
    <div class="form-group row">
        <label for="StudentResidence" class="text-justify col-md-4 col-form-label">Student Residence</label>
        <div class="col-md-8">
            <input type="text" name="studResid" class="form-control" id="StudentResidence" value="" placeholder="" required/>
        </div>
    </div>
    <div class="form-group row">
        <label for="StreetNumber" class="text-justify col-md-4 col-form-label">StreetNumber</label>
        <div class="col-md-8">
            <input type="text" name="streetNo" class="form-control" id="StreetNumber" value="" placeholder="" required/>
        </div>
    </div>
    <div class="form-group row">
        <label for="City" class="text-justify col-md-4 col-form-label">City</label>
        <div class="col-md-8">
            <input type="text" name="city" class="form-control" id="City" value="" placeholder="" required/>
        </div>
    </div>
    <div class="form-group row">
        <label for="Province" class="text-justify col-md-4 col-form-label">Province</label>
        <div class="col-md-8">
            <input type="text" name="province" class="form-control" id="Province" value="" placeholder="" required/>
        </div>
    </div>
    <div class="form-group row">
        <label for="PostalCode" class="text-justify col-md-4 col-form-label">Postal Code</label>
        <div class="col-md-8">
            <input type="text" name="postal" class="form-control" id="Postal" value="" placeholder="" required/>
        </div>
    </div>


    <input type="submit" name="submit" value="Create" class="btn btn-primary"><br><br>
</form>

@endsection