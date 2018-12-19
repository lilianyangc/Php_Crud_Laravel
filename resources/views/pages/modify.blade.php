<?php
/**
 * Created by PhpStorm.
 * User: Lilian
 * Date: 2018-11-17
 * Time: 3:23 PM
 */

?>

@extends('layouts.app')

@section('content')
    <br><h1 class="display-4"> Modify record:</h1><br>


    <form method="POST" action="{{ route('institutions.update', $institution->id) }}" class=" offset-md-3 col-md-6">
        @method('PATCH')
        @csrf
        <div class="form-group row">
            <label for="Institution" class="text-justify col-md-4 col-form-label">Institution</label>
            <div class="col-md-8">
                <input type="text" name="institution" class="form-control" id="Institution" value="{{ $institution -> institution_name}}" placeholder="" required/>
            </div>
        </div>
        <div class="form-group row">
            <label for="StudentResidence" class="text-justify col-md-4 col-form-label">Student Residence</label>
            <div class="col-md-8">
                <input type="text" name="studResid" class="form-control" id="StudentResidence" value="{{ $institution -> student_residence}}" placeholder="" required/>
            </div>
        </div>
        <div class="form-group row">
            <label for="StreetNumber" class="text-justify col-md-4 col-form-label">StreetNumber</label>
            <div class="col-md-8">
                <input type="text" name="streetNo" class="form-control" id="StreetNumber" value="{{ $institution -> street_number}}" placeholder="" required/>
            </div>
        </div>
        <div class="form-group row">
            <label for="City" class="text-justify col-md-4 col-form-label">City</label>
            <div class="col-md-8">
                <input type="text" name="city" class="form-control" id="City" value="{{ $institution -> city}}" placeholder="" required/>
            </div>
        </div>
        <div class="form-group row">
            <label for="Province" class="text-justify col-md-4 col-form-label">Province</label>
            <div class="col-md-8">
                <input type="text" name="province" class="form-control" id="Province" value="{{ $institution -> province}}" placeholder="" required/>
            </div>
        </div>
        <div class="form-group row">
            <label for="PostalCode" class="text-justify col-md-4 col-form-label">Postal Code</label>
            <div class="col-md-8">
                <input type="text" name="postal" class="form-control" id="Postal" value="{{ $institution -> postal_code}}" placeholder="" required/>
            </div>
        </div>

        <input type="hidden" name="update_id" value="">
        <input type="submit" name="update" value="Update" class="btn btn-warning"><br><br>
    </form>
    @endsection
