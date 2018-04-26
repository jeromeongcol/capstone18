

        <div class="SeletedMenuHeader">
          
         <div class="row">
          
            <div class="col-md-3">
              <h4>Reports > Projects</h4>
            </div>


            <div class="col-md-9 text-right reports-submenu">


                <div class="btn-group" role="group" aria-label="First group">

                  <button type="button" class="btn btn-primary menu-custom reports-menu">SALES</button>
                 
                   <button type="button" class="btn btn-primary menu-custom report-agents" >AGENTS</button>

                   <button type="button" class="btn btn-primary menu-custom report-developers">DEVELOPERS</button>

                   <button type="button" class="btn btn-primary menu-custom report-projects active">PROJECTS</button>

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




         <div class="row">



            <div class="col-md-12 col-xs-12" id="Reports-Table-con">

              @include('dashboard.reports.partials.projects-table')

            </div>




         </div>











        </div> <!-- end panelboxy-->
      </div> <!-- end panel-->
    </div>
  </div>










</div>