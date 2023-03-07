<div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="row align-items-center mb-2">
                <div class="col">
                  <h2 class="h5 page-title">Welcome!</h2>
                </div>
                <div class="col-auto">
                  <form class="form-inline">
                    <div class="form-group d-none d-lg-inline">
                      <label for="reportrange" class="sr-only">Date Ranges</label>
                      <div id="reportrange" class="px-2 py-2 text-muted">
                        <span class="small"></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="button" class="btn btn-sm"><span class="fe fe-refresh-ccw fe-16 text-muted"></span></button>
                      <button type="button" class="btn btn-sm mr-2"><span class="fe fe-filter fe-16 text-muted"></span></button>
                    </div>
                  </form>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="card shadow mb-4">
                    <div class="card-body">
                      <div class="py-5 text-center">
                        <p class="text-muted mb-2">Doanh Thu Của Cửa Hàng</p>
                       
                        <?php
                        $tongthang=0;
                         foreach($doanhthuthangs as $doanhthuthang){

                          $tongthang+=$doanhthuthang['fDoanhThu'];
                        } ?>
                        <h2 class="mb-1"><?php echo $tongthang; ?></h2>
                        <?php
                        $tongthangtruoc=0;
                         foreach($doanhthuthangtruocs as $doanhthuthangtruoc){

                          $tongthangtruoc+=$doanhthuthangtruoc['fDoanhThu'];
                        } ?>
                        <span class="small <?php if(($tongthang-$tongthangtruoc)>0){echo "text-success";}else{echo "text-danger";}  ?>">
                        <?php echo ($tongthang-$tongthangtruoc) ?></span>
                      </div>
                      <div class="row align-items-center mb-1">
                        <div class="col-auto">
                          <div class="my-2 text-center">
                            <small class="text-danger pr-2 mr-2">High</small>
                            <span class="text-warning px-2 mx-2">Medium</span>
                            <span class="text-success px-2 mx-2">Low</span>
                          </div>
                        </div>
                        <div class="col">
                          <small class="h6 mb-0 text-muted">Statistics</small>
                        </div>
                      </div>
                      <div class="progress rounded mb-3" style="height:14px">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">15%</div>
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">30%</div>
                        <div class="progress-bar bg-success" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">20%</div>
                      </div>
                    </div> <!-- .card-body -->
                  </div> <!-- .card -->
                 
                </div> <!-- ./col -->
              
              </div> <!-- end section -->
            </div>
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->