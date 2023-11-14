<link rel="stylesheet" href="<?=base_url('template/')?>plugins/fullcalendar//packages/core/main.css">
<link rel="stylesheet" href="<?=base_url('template/')?>plugins/fullcalendar/packages/daygrid/main.css">
<link rel="stylesheet" href="<?=base_url('template/')?>plugins/fullcalendar/packages/timegrid/main.css">
<script src="<?=base_url('template/')?>plugins/fullcalendar/packages/core/main.js"></script>
<script src="<?=base_url('template/')?>plugins/fullcalendar/packages/interaction/main.js"></script>
<script src="<?=base_url('template/')?>plugins/fullcalendar/packages/daygrid/main.js"></script>
<script src="<?=base_url('template/')?>plugins/fullcalendar/timegrid/main.js"></script>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- edit Modal -->
<div class="modal fade" id="new_schedule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0);" id="formAddSchedule">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="row mt-2">
                    <div class="col-md-4">Add Title</div>
                    <div class="col-md-8"><input type="text" name="title" class="form-control"></div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-4">Date</div>
                    <div class="col-md-8">
                    <input type="hidden" id="apptStartTime" class="form-control">
                    <input type="hidden" id="apptEndTime" class="form-control">
                    <input type="hidden" id="apptAllDay" class="form-control">
                    <input type="date" name="date" class="form-control"></div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-4">Location</div>
                    <div class="col-md-8"><input type="text" name="location" class="form-control"></div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-4">Description</div>
                    <div class="col-md-8"><textarea  name="description" class="form-control"></textarea></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <div class="col-md-6">
                  <button class="btn btn-danger">Cancel</button>
                </div>
                <div class="col-md-6" >
                  <button type="submit" class="btn btn-success">Save</button>
                </div>
              </div>
            </div>
          </form>
        </div>
    </div>
</div>
