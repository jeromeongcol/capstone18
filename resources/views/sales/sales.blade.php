@extends('layouts-admin.app')

@section('content')
    <!-- MAIN -->
    <div class="main" id="app">
      <!-- MAIN CONTENT -->
      <div class="main-content">

          <div class="SeletedMenuHeader">
              <div class="row">
                    <div class="col-md-4">
                      <h4><i class="fa fa-shopping-bag" aria-hidden="true"></i> <span class="SelectedMenuTitle">Approved Sales</span></h4>
                    </div>

                    <div class="col-md-8">

                       <div class="btn-group btn-group-menu" role="group" aria-label="First group">

                       <button type="submit" class="btn btn-info btn-md salesBtnShowList">
                        <i class="fa fa-thumbs-up" aria-hidden="true"></i> Approved Sales</button>
                        
                      
                          <button type="submit" class="btn btn-info btn-md salesBtnForApprovalList">
                          <i class="fa fa-thumbs-up" aria-hidden="true"></i> Pending Sales</button>
                        
                        
                          <button type="submit" class="btn btn-info btn-md salesBtnCancelledList">
                          <i class="fa fa-times" aria-hidden="true"></i> Cancelled Sales</button>

                           <a href="sales/add">
                            <button class="btn btn-primary pull-right"><i class="fa fa-plus" aria-hidden="true"></i> Add Sales</button>
                            </a>

                      </div>

                       
                    </div>

                </div>
         </div>
        
        <div class="container-fluid">


          <!-- OVERVIEW -->
          <div class="row list" id="sales-list">
              @include('sales.partials.sales-list')
          </div>
          <!-- END MAIN CONTENT -->
          
        </div>
    <!-- END MAIN -->
  </div>
</div>


@include('sales.partials.modals.select-agent')
@include('sales.partials.modals.select-project')

@endsection
