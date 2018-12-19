<?php

namespace App\Http\Controllers;
use App\Institution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    public function index()
    {
        $institutions = Institution::paginate(5);
        return view("pages.home")->with('institutions', $institutions);
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'institution'=> 'required',
            'studResid' => 'required',
            'streetNo'=> 'required',
            'city' => 'required',
            'province'=> 'required',
            'postal' => 'required'
        ));

        $institution = new Institution();
        $institution->institution_name = $request->get('institution');
        $institution->student_residence = $request->get('studResid');
        $institution->street_number = $request->get('streetNo');
        $institution->city = $request->get('city');
        $institution->province = $request->get('province');
        $institution->postal_code = $request->get('postal');
        $institution->save();

        //redirecting back to the page with a message
        return redirect()->action('HomeController@add')->with('success', 'Add successful');
    }

    public function edit($id)
    {
        $institution = Institution::find($id);

        //returning a compact array
        return view('pages.modify', compact('institution'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'institution'=> 'required',
            'studResid' => 'required',
            'streetNo'=> 'required',
            'city' => 'required',
            'province'=> 'required',
            'postal' => 'required'
        ));

        $institution = Institution::find($id);
        $institution->institution_name = $request->get('institution');
        $institution->student_residence = $request->get('studResid');
        $institution->street_number = $request->get('streetNo');
        $institution->city = $request->get('city');
        $institution->province = $request->get('province');
        $institution->postal_code = $request->get('postal');
        $institution->save();

        //redirecting to the modify page with id and success of updating
        return redirect('/modify/'.$id)->with('success', 'Entry Updated!');

    }

    public function destroy($id)
    {
        $institution = Institution::find($id);
        $institution->delete();

        //redirecting to root page with success message
        return redirect('/')->with('success', 'Successfully deleted');


    }

    public function search()
    {
        $search = Input::get('search');
        if($search != " "){
            $entry = Institution::where('institution_name','LIKE', '%'.$search.'%')
                ->orWhere('student_residence','LIKE','%'.$search.'%')
                ->orWhere('street_number','LIKE','%'.$search.'%')
                ->orWhere('city','LIKE','%'.$search.'%')
                ->orWhere('province','LIKE','%'.$search.'%')
                ->orWhere('postal_code','LIKE','%'.$search.'%')
                ->get();

            if(count($entry) > 0)
                return view('pages.search') ->withDetails($entry)->withQuery($search);

        }
        return view('pages.search') ->withMessage("No entry found!");
    }

    public function import()
    {
        try {
            $uploaded_file = isset($_FILES['file']['tmp_name']) ? $_FILES['file']['tmp_name'] : '';
            $success = false;
            $outputMsg = 'No file uploaded';

            //check file type
            $mimes = array(
                'application/vnd.ms-excel',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'text/plain',
                'text/csv',
                'text/tsv');
            if ( ! in_array($_FILES['file']['type'], $mimes) ) {
                throw new \Exception('Error: Import failed. Invalid file type.');
            }

            //check uploaded file
            $uploaded_handle = fopen( $uploaded_file, 'r' );
            $row = fgetcsv($uploaded_handle);
            $columns = count($row);
            fclose($uploaded_handle);
            if ( $columns != 6 ) {
                throw new \Exception('Error: Import failed. Incorrect number of columns.');
            }

            if ($uploaded_file) {

                $db_con = mysqli_connect('server.gblearn.com', 'f8151657_user',
                    'Password1', 'f8151657_energy');
                if (mysqli_connect_errno() > 0) {
                    $success = false;
                    $outputMsg = 'Unable to connect to database.';
                } else {
                    $csv_upload_path = str_replace('\\', '/', $uploaded_file);
                    $query = sprintf("LOAD DATA LOCAL INFILE '%s'
                 INTO TABLE institutions
                 COLUMNS TERMINATED BY ','
                 OPTIONALLY ENCLOSED BY '\"' 
                 LINES TERMINATED BY '\\n'
                 IGNORE 1 LINES 
                 (institution_name,student_residence,street_number,city,province,postal_code) 
                 SET id=NULL", //CSV columns
                        $csv_upload_path);

                    //places the query in the database connection
                    $result = mysqli_query($db_con, $query);
                    if ($result) {
                        $success = true;
                        $outputMsg = 'Import successful.';
                    } else {
                        $outputMsg = 'Failed to import. Please try again later or contact support.';
                    }
                    mysqli_close($db_con);
                }
            }
        }
        catch(\Exception $e) {

            //if needle is in the thrown exception, output the specific message
            if ( strpos($e->getMessage(), 'Error: ') !== false ) {
                $outputMsg = $e->getMessage(); //for debugging
            } else {
                $outputMsg = 'Import failed.';
            }
        }

        if ($success){
            return redirect('/import')->with('success', $outputMsg);
        }else{
            //redirectting back to the same page with withErrors message
            return Redirect::back()->withErrors([$outputMsg]);
        }

    }

    function exportData()
    {

        $institutions = Institution::all();

        $temp_file= '../storage/app/public/energy_export_file.csv';
        if(!file_exists($temp_file)) {
            touch($temp_file);
            $handle = fopen($temp_file, 'w');

        }else{
            $handle = fopen($temp_file, 'w');
        }


        $array = array("institution_name","student_residence","street_number","city","province","postal_code");

        fputcsv($handle, $array);

        foreach ( $institutions as $row ) {
            $array = array(
                $row->institution_name,
                $row->student_residence,
                $row->street_number,
                $row->city,
                $row->province,
                $row->postal_code
            );

            fputcsv($handle, $array);
        }
        fclose($handle);

        return response()->download($temp_file, 'energy_export.csv');

    }



}
