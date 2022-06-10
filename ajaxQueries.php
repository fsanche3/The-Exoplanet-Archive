<?php
include('dbcon.php');
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = mysqli_real_escape_string($conn,$_POST['search']['value']); // Search value

## Search
$searchQuery = " ";
if($searchValue != ''){
   $searchQuery .= " and (exoID like '%".$searchValue."%' or PlanetName like '%".$searchValue."%' or
            SyDist like '%".$searchValue."%' or
            PlOrb like '%".$searchValue."%' or DiscYear like '%".$searchValue."%' or DiscMeth like'%".$searchValue."%' ) ";
}

## Total number of records without filtering
$sel = mysqli_query($conn,"select count(*) as allcount from exo");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($conn,"select count(*) as allcount from exo WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$exoQuery = "select * from exo WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$exoRecords = mysqli_query($conn, $exoQuery);

$data = array();

while($row = mysqli_fetch_assoc($exoRecords)){
    $data[] = array(
            "exoID"=>$row['exoID'],
            "PlanetName"=>$row['PlanetName'],
            "SyDist"=>$row['SyDist'],
            "PlOrb"=>$row['PlOrb'],
            "DiscYear"=>$row['DiscYear'],
            "DiscMeth"=>$row['DiscMeth']
        );
}

## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);

?>
