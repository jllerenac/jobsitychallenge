<div class="container well well-sm  col-xs-12" >

<div class="panel panel-default" style="margin-bottom: 0">
  <div  class="panel-heading" style="padding: 0" >
  <div class="input-group-sm row">
      <label id="lblconc" class="col-xs-8 col-form-label" style="font-size: 12px"></label>
      <input id="idconc" type="hidden">
  </div>
  <input id="queryText" type="text" maxlength="50" class="col-xs-5 input-sm" placeholder="Search Text in Entry / Leave it empty to retrieve all records">  
  <button onclick="queryEntries();"  class="btn btn-primary btn-sm " >Search</button> 
  <?php
   if($this->session->id)  {
  echo "<button onclick=\"addEntry()\" class=\"btn btn-primary btn-sm \" title=\"Add Entry\" ><span class='glyphicon glyphicon-plus' aria-hidden='true'></span></button>";
   }
  ?> 
  <ul class="pagination pagination-sm panel-pagination col-xs-5 pull-right" style="margin: 0; padding: 0" id="pagEntry">
    <li><a href="#" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>
    <?php       
            $numPages = floor($result->num_rows()/3);
            if($result->num_rows()%3 <> 0) {$numPages+=1;}
            for ($x = 1; $x <= $numPages; $x++) {
                   echo " <li><a href='#' >$x</a></li>"; } 
                   ?>
    <li><a href="#" aria-label="Siguiente"><span aria-hidden="true">&raquo;</span></a></li>
   </ul>
  </div>
  
  <table  class="table table-bordered" id="tableEntry" role="grid" style="font-size: 12px;"> 
            <thead> 
                <tr>  <th style="padding: 0" class="col-xs-2">Title</th> <th style="padding: 0" class="col-xs-5">Entry</th>
                <th style="padding: 0" class="col-xs-2">Twitter Username</th> <th style="padding: 0" class="col-xs-1">Creation Date</th>  <th style="padding: 0" class="col-xs-2">User</th> 
                </tr> </thead> 
            <tbody id ="tabQuery" > 
            <?php   
             foreach ($result->result() as $row)
             {
                $userName = $this->db->query("select josellerena.obtain_username($row->user_id) as userName")->row();
                $twitterUser = $this->db->query("select josellerena.obtain_twitterUser($row->user_id) as twitterUser")->row();
                echo "<tr> 
                <td style='padding: 0; display: none' id='entryId"."$row->id'>$row->id</td>
                <td style='padding: 0;' id='entryTitle"."$row->id'>$row->title</td> 
                <td style='padding: 0;' id='entryValue"."$row->id'>$row->entry</td>
                <td style='padding: 0;' id='twitterUser"."$row->id'>$twitterUser->twitterUser</td>
                <td style='padding: 0;' id='entryDate"."$row->id'>$row->entry_date</td>  
                <td style='padding: 0; display: none' id='userId"."$row->user_id'>$row->user_id</td>
                <td style='padding: 0;' id='userName"."$row->id'>$userName->userName</td>";
                if($this->session->id) 
                {
                    echo "<td style='padding: 0; cursor: pointer;' title='Edit Entry'><span onclick='editEntry($row->id);' class='glyphicon glyphicon-edit' aria-hidden='true'></span></td> "; 
                }
                echo "<td style='padding: 0; cursor: pointer;' title='User Page'><span onclick='userPage($row->user_id);' class='glyphicon glyphicon-user' aria-hidden='true'></span></td> </tr>";
             }
             ?>
            </tbody> </table>
</div></div>

<div id="addE" class="modal fade" role="dialog">
  <div class="modal-dialog">
      
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Entry</h4>
      </div>
      <div class="modal-body">
        
        <form class="contact" id="formIns">
<fieldset>
    <div class="modal-body">
        <div class="input-group-sm row ">
        <label for="entryDesc" class="col-sm-4 col-form-label">Insert Title</label>
        <div class="col-sm-4 input-group-sm ">
            <input type="text" class="form-control " id="entryTitle" aria-describedby="title" maxlength="50" placeholder="Cannot Be Empty" >
        </div> </div>
        <div class="input-group-sm row ">
            <label for="entryDesc" class="col-sm-4 col-form-label">Insert Entry</label>
            <input type="text" class="form-control " id="entryVal" aria-describedby="description" maxlength="140" placeholder="Cannot Be Empty" >
        </div>
    </div>
     
 </fieldset>
 </form>
      </div>
      <div class="modal-footer">
           <button class="btn btn-primary" id="insertEntry">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="updE" class="modal fade" role="dialog">
  <div class="modal-dialog">
      
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Entry</h4>
      </div>
      <div class="modal-body">
        
        <form class="contact" id="formUpd">
<fieldset>
    <div class="modal-body">
        <div class="input-group-sm row ">
        <input id="uEntryId" type="hidden">
        <label for="entryDesc" class="col-sm-4 col-form-label">Insert Title</label>
        <div class="col-sm-4 input-group-sm ">
            <input type="text" class="form-control " id="uEntryTitle" aria-describedby="title" maxlength="50" placeholder="Cannot Be Empty" >
        </div> </div>
        <div class="input-group-sm row ">
            <label for="entryDesc" class="col-sm-4 col-form-label">Insert Entry</label>
            <input type="text" class="form-control " id="uEntryVal" aria-describedby="description" maxlength="140" placeholder="Cannot Be Empty" >
        </div>
    </div>
     
 </fieldset>
 </form>
      </div>
      <div class="modal-footer">
           <button class="btn btn-primary" id="updateEntry">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="rest" ></div>  
<div class='container well well-sm  col-xs-12' id='twt' > </div>
<script type='text/javascript'>
    var paginationEntry = new Pagination('tableEntry', 3); 
    paginationEntry.init(); 
    paginationEntry.showPageNav('paginationEntry', 'pagEntry'); 
    paginationEntry.showPage(1); 
</script>



 