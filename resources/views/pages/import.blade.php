<?php
/**
 * Created by PhpStorm.
 * User: Lilian
 * Date: 2018-11-17
 * Time: 2:44 PM
 */

?>

@extends('layouts.app')

@section('content')

<br><br>
<h1>Choose a file to import</h1>
<br><br>
<form action="" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file"/><br><br><br>
    <input type="submit" value="Submit"/>
</form>


@endsection
