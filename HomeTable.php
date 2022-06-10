<?php

  $servername = 'pi.cs.oswego.edu:3306';
  $username = 'fsanche3';
  $password = 'isc496';
  $dbname = 'fsanche3_22S';

$conn = new mysqli($servername,$username,$password,$dbname);
$query = "SELECT * FROM exo";
$result = mysqli_query($conn, $query);
?>

<div class="container">
<h3 align= "center">Exoplanet Archive</h3>
<p align= "center"><em> Click an exoplanet for comparison using Tableau</em></p>
<div class="table-responsive">
  <table id="exo-data" class="table table-striped table-bordered">
    <thead>
        <tr>
          <th> exoID </th>
           <th>Planet Name</th>
             <th>Distance(pc)</th>
           <th>Orbital Period(days)</th>
           <th>Discovery Year</th>
           <th>Discovery Method</th>
          </tr>
   </thead>

</table>
</div>
</div>
<script>
$(document).ready(function(){
            var exoDataTable = $('#exo-data').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url':'ajaxfile.php'
                },
                pageLength: 10,
                'columns': [
                    {data: 'exoID',
                    // column render id = row accesor
                      render : function(data, type, row){
                           return '<a href= "details.php?ID='+row.exoID+'"> '+data+'</a>';
                      }
                     },
                    { data: 'PlanetName',
                    // column render id = row accesor
                      render : function(data, type, row){
                           return '<a href= "details.php?ID='+row.exoID+'"> '+data+'</a>';
                      }
                  },
                    { data: 'SyDist',
                    render : function(data, type, row){
                         return '<a href= "details.php?ID='+row.exoID+'"> '+data+'</a>';
                    }
                   },
                    { data: 'PlOrb',
                    render : function(data, type, row){
                         return '<a href= "details.php?ID='+row.exoID+'"> '+data+'</a>';
                    }
                   },
                    { data: 'DiscYear',
                    render : function(data, type, row){
                         return '<a href= "details.php?ID='+row.exoID+'"> '+data+'</a>';
                    }
                   },
                    { data: 'DiscMeth',
                    render : function(data, type, row){
                         return '<a href= "details.php?ID='+row.exoID+'"> '+data+'</a>';
                    }
                   },
                ]
            });
        });

 </script>
