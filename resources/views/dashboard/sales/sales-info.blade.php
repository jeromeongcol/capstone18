<!-- MAIN -->
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container container-full">

            <div class="SeletedMenuHeader">
              <div class="row">
                  <div class="col-md-5">
                      <h4>SALES TALLY DETAILS</h4>

                  </div>

                   <div class="col-md-6 text-right">
                      <h4><button type="submit" class="btn btn-primary btn-lg" id="printSalesDetailsBtn"><i class="fa fa-print"></i> PRINT</button></h4>

                  </div>
              </div>
            </div>

            <div class="panel panel-profile panel-sales">
                <div class="row">


                 <table class="table data-table-sales-info-print">
                      <thead>
                        <tr>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>

                        </tr>
                      </thead>
                      <tbody>

                        <tr>
                          <td>-</td>
                          <td>Details of Project</td>
                          <td></td>
                         <td></td>
                         <td></td>
                        </tr>

                        <tr>
                            <td>-</td>
                           <td>Project Name : </td>
                           <td>{{ $sales->project_name }}</td>

                            <td>Total Contract Price : </td>
                           <td>{{ $sales->total_contract_price }}</td>

                        </tr>


                        <tr>
                          <td>-</td>
                          <td>Project Type : </td>
                           <td>{{ $sales->project_type }}</td>

                            <td>Reserve Date : </td>
                           <td>{{ $sales->date_reserve }}</td>

                        </tr>


                        <tr>
                            <td>-</td>
                          <td>Project Location : </td>
                           <td>{{ $sales->project_location }}</td>

                            <td></td>
                            <td></td>

                        </tr>

                        <tr>
                          <td>-</td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                         
                        </tr>


                        <tr>
                          <td>-</td>
                          <td>Developer Details</td>
                          <td></td>
                          <td></td>
                          <td></td>
                         
                        </tr>



                        <tr>
                            <td>-</td>
                          <td>Company Name : </td>
                           <td>{{ $sales->developer_name }}</td>
                           <td></td>
                           <td></td>

                        </tr>


                        <tr>
                          <td>-</td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                         
                        </tr>


                        <tr>
                           <td>-</td>
                           <td>Agent Details</td>
                           <td></td>
                           <td></td>
                           <td></td>

                        </tr>


                        <tr>
                           <td>-</td>
                           <td>Agent Name : </td>
                           <td>{{ $sales->agent_name }}</td>
                           <td>Agent Email : </td>
                           <td>{{ $sales->agent_email }}</td>

                        </tr>

                        <tr>
                           <td>-</td>
                           <td>Agent Rank : </td>
                           <td>{{ $sales->agent_rank }}</td>
                           <td></td>
                           <td></td>

                        </tr>


                        <tr>
                           <td>-</td>
                           <td>Buyer Details</td>
                           <td></td>
                           <td></td>
                           <td></td>

                        </tr>

                        <tr>
                           <td>-</td>
                           <td>Buyer's Name : </td>
                           <td>{{ $sales->client_name }}</td>
                           <td></td>
                           <td></td>

                        </tr>


                        
                      </tbody>
                    </table>



                

                </div>
            </div>



        </div>
    </div>
</div>

