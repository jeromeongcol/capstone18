        <div class="SeletedMenuHeader">
          
         <div class="row">
            <div class="col-md-4 col-xs-4">
              <h4>Sales > Approved</h4>
            </div>

            <div class="col-md-8 col-xs-8 text-right">

              <div class="btn-group" role="group" aria-label="First group">
                <button type="button" class="btn btn-primary menu-custom sales-menu-approved active">APPROVED SALES</button>

               <button type="button" class="btn btn-primary menu-custom sales-menu-cancelled">CANCELLED SALES</button>
               
                  <button type="button" class="btn btn-primary menu-custom sales-menu-pending">PENDING SALES</button>

              </div>

              <button type="button" class="btn btn-primary"  id="AddSalesBtn">
                <img src="{{ asset('layouts/img/add-user.png') }}"> Tally Sales 
              </button>

            </div>
         </div>

        </div>


        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">


              <div class="panel">
                <div class="panel-body page-content">

                    
                @include("dashboard.sales.partials.sales-table")
          

                </div>
              </div>
              <!-- END RECENT PURCHASES -->
            </div>
          </div>



        </div>