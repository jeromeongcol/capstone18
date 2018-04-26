

        <div class="SeletedMenuHeader">
          
         <div class="row">
          
            <div class="col-md-3">
              <h4>Reports > Agents</h4>
            </div>


            <div class="col-md-9 text-right reports-submenu">


                <div class="btn-group" role="group" aria-label="First group">

                  <button type="button" class="btn btn-primary menu-custom reports-menu">SALES</button>
                 
                   <button type="button" class="btn btn-primary menu-custom report-agents active" >AGENTS</button>

                   <button type="button" class="btn btn-primary menu-custom report-developers">DEVELOPERS</button>

                   <button type="button" class="btn btn-primary menu-custom report-projects">PROJECTS</button>

                </div>

             <div class="btn-group" role="group" aria-label="First group">

                <button type="submit" class="btn btn-success" id="pdfBtn"><i class="fa fa-file-pdf-o"></i> PDF</button>

                <button type="submit" class="btn btn-success" id="excelBtn"><i class="fa fa-file-excel-o"></i> EXCEL</button>

                 <button type="submit" class="btn btn-success" id="printBtn"><i class="fa fa-print"></i> PRINT</button>

             </div>
             
            </div>

         </div>

        </div>

    

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">




      <div class="panel">
        <div class="panel-body page-content">


        


          <form action="/reports/agents/filters" method="GET" id="Filter_Reports_Agent_Form">

            {{ csrf_field() }}

         <div class="row">

          

            <div class="col-md-3 col-xs-12 report-filters">
              
              <div class="form-group">
                   <span class="input-group-addon">Filter By Status</span>
                    <select class="form-control" name="Filter_By_Status" id="Filter_By_Status">
                      <option value="ALL">ALL</option>
                      <option value="ACTIVE">ACTIVE AGENTS</option>
                      <option value="NOT_ACTIVE">NOT ACTIVE AGENTS</option>
                    </select>
              </div>        

            </div>


            <div class="col-md-2 col-xs-12 report-filters">
              
              <div class="form-group">
                   <span class="input-group-addon">Filter By Rank</span>
                    <select class="form-control" name="Filter_Agent_By_Rank" id="Filter_Agent_By_Rank">
                      <option value="ALL">ALL</option>
                      <option value="PC">PC</option>
                      <option value="RPC">RPC</option>
                      <option value="GID">GID</option>
                      <option value="PTM">PTM</option>
                    </select>
              </div>        

            </div>




            <div class="col-md-2 col-xs-12 report-filters filter_by_top">
              
              <div class="form-group">
                   <span class="input-group-addon">Get Top</span>
                   <div class="input-group-con"> 
                     <input class="form-control" id="Filter_Get_Top_Input" name="Filter_Get_Top_Custom_Input" value="10" type="text">
                      <select class="form-control" name="filter_by_top" id="Filter_Get_Top">
                        <option value="ALL">ALL</option>
                        <option value="5">TOP 5</option>
                        <option value="10">TOP 10</option>
                        <option value="20">TOP 20</option>
                        <option value="CUSTOM">CUSTOM</option>
                      </select>
                  </div>

              </div>        

            </div>



            <div class="col-md-1 col-xs-12 report-filters filter_btn_submit_con pull-right">

                <button type="submit" class="btn btn-primary btn-lg" id="filter_btn">GENERATE</button>        

            </div>



         </div>   


         </form>















         <div class="row">



            <div class="col-md-12 col-xs-12" id="Reports-Table-con">

             {{--  @include('dashboard.reports.partials.agents-table') --}}

            </div>




         </div>











        </div> <!-- end panelboxy-->
      </div> <!-- end panel-->
    </div>
  </div>










</div>