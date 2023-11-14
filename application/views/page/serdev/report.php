<style>
    #chart_progress{
        width:100% !important;
        height:250px !important;
    }
    #chart_status,#chart_obstacle{
        width:100% !important;
        height:290px !important;
        padding:15px ;
    }

    thead tr td {
            font-size:14px;
        }

        tbody tr td {
            font-size:12px;
        }

        div.dataTables_wrapper {
            width: 100%;
            margin: 0 auto;
        }
</style>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <canvas id="chart_progress"></canvas>
                    </div>
                    <div class="col-md-12">
                        <table class="table display nowrap" id="table_progress">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Project</td>
                                    <td>Technical Lead</td>
                                    <td>Priority</td>
                                    <td>Status</td>
                                    <td>#</td>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <canvas id="chart_status"></canvas>
        </div>

        <div class="card">
            <canvas id="chart_obstacle"></canvas>
        </div>
    </div>
</div>

<!-- Edit Project -->
<div class="modal fade" id="edit_projek" tabindex="-1" role="dialog" aria-labelledby="edit_projek" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
         <div class="modal-header">        
             <h5 class="modal-title" id="edit_projekss">Edit</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <form action="javascript.void(0);" id="form_edit_projek">
          <div class="modal-body">
            <div>
                <div class="mt-2 mb-2">Technical Lead</div>
                <input type="hidden" name="id" id="id">
                <select class="form-control form-control-sm" name="tech_lead" id="tech_lead">
                </select>
            </div>

            <div>
                <div class="mt-2 mb-2">Priority</div>
                <select class="form-control form-control-sm" name="priority" id="priority">
                    <option value="0">Not Priority</option>
                    <option value="1">Priority</option>
                </select>
            </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
          </div>
          </form>
     </div>
   </div>
</div>