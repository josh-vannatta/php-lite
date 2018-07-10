<?php
   $page_title = 'Admin | Dashboard';
   App::view('partials/header', compact('page_title'));
 ?>
      <!-- Dashboard Overview -->
      <section class="row">
        <!-- Visitors -->
        <div class="col-lg-4">
          <a class="--module --card --dash-monthly" target="_blank" href="https://analytics.google.com/analytics/web?identifier">
            <h1 class="--quantity"><?= $monthly_avg ?></h1>
            <h4 class="--subheader">Monthly Visitors</h4>
            <h6 class="--descriptor">This is an average value</h6>
            <div class="--visual">
              <?php App::view('vector/dash_users') ?>
            </div>
          </a>
        </div>
        <!-- Page Visits -->
        <div class="col-lg-4">
          <a class="--module --card --dash-total" target="_blank"  href="https://analytics.google.com/analytics/web/">
            <h1 class="--quantity"><?= $page_visits ?></h1>
            <h4 class="--subheader">Page visits</h4>
            <h6 class="--descriptor">Since neuraptive.com launch</h6>
            <div class="--visual" style="margin: -5px">
              <?php App::view('vector/dash_pages') ?>
            </div>
          </a>
        </div>
        <!-- New Messages -->
        <div class="col-lg-4">
          <div class="--module --card --dash-messages">
            <h1 class="--quantity"><?= App::database('messages')->count() ?></h1>
            <h4 class="--subheader">New Messages</h4>
            <h6 class="--descriptor">Sent from contact page</h6>
            <a href="/admin/messages/clear" type="button" name="button" class="--transition --basic-shadow --clear-messages">
              <div><i class="material-icons">done</i>
                  <div class="--helper-msg">Mark as read</div>
              </div>
            </a>
            <div class="--visual">
              <?php App::view('vector/dash_messages') ?>
            </div>
          </div>
        </div>
        <div class="col-xs-12">
          <div class="--seperator"></div>
        </div>
      </section>
      <!-- Dashboard Charts -->
      <section class="row">
        <!-- Monthly Visits Chart -->
        <div class="col-md-7">
          <div class="--module --dash-stats">
            <div class="--header">
              <h4>Visits per month</h4>
            </div>
            <div class="--body">
              <canvas id="dash-stats-chart"></canvas>
              <script type="text/javascript">
                var c_data = [<?php
                    $line_chart = array_reverse($line_chart);
                    foreach ($line_chart as $month) {
                      echo $month . ',';
                    }
                  ?>];
              </script>
            </div>
          </div>
        </div>
        <!-- Browser Data -->
        <div class="col-md-5">
          <div class="--module">
            <div class="--header">
              <h4>Top Browsers (average)</h4>
            </div>
            <?php
              class Browser
              {
                  public $name;
                  public $visits;
                  public $percent;
                  public function __construct($name, $visits)
                  {
                    $this->name = $name; $this->visits = $visits;
                  }
                  public function getPercent($max)
                  {
                    $this->percent = $this->visits / $max * 100;
                    $this->percent = number_format($this->percent, 2);
                  }
              }

              $browser_stats = [
                new Browser('Chrome', $monthly_avg * .5),
                new Browser('Firefox', $monthly_avg * .3),
                new Browser('Safari', $monthly_avg * .4),
                new Browser('IE / Edge', $monthly_avg * .1),
              ];

              usort($browser_stats, function($a, $b){
                return ($a->visits > $b->visits)?-1:1;
              });

              $browser_max = $browser_stats[0]->visits * 1.2;

              foreach($browser_stats as $browser)
                $browser->getPercent($browser_max);

             ?>
            <div class="--body">
              <div class="row">
                <div class="col-md-12 col-sm-6 col-xs-12 --dash-browsers">
                  <p class="--no-margin"><?php echo $browser_stats[0]->name ?></p>
                  <div class="--bar-chart">
                    <div style="width: <?php echo $browser_stats[0]->percent ?>%; display: inline-block"></div>
                    <h4><?php echo ceil($browser_stats[0]->percent).'%' ?></h4>
                    <div class="--bar-fill" style="width: <?php echo $browser_stats[0]->percent ?>%"></div>
                  </div>
                  <p class="--no-margin"><?php echo $browser_stats[1]->name ?></p>
                  <div class="--bar-chart">
                    <div style="width: <?php echo $browser_stats[1]->percent ?>%; display: inline-block"></div>
                    <h4><?php echo ceil($browser_stats[1]->percent).'%' ?></h4>
                    <div class="--bar-fill" style="width: <?php echo $browser_stats[1]->percent ?>%"></div>
                  </div>
                </div>
                <div class="col-md-12 col-sm-6 col-xs-12 --dash-browsers">
                  <p class="--no-margin"><?php echo $browser_stats[2]->name ?></p>
                  <div class="--bar-chart">
                    <div style="width: <?php echo $browser_stats[2]->percent ?>%; display: inline-block"></div>
                    <h4><?php echo ceil($browser_stats[2]->percent).'%' ?></h4>
                    <div class="--bar-fill" style="width: <?php echo $browser_stats[2]->percent ?>%"></div>
                  </div>
                  <p class="--no-margin"><?php echo $browser_stats[3]->name ?></p>
                  <div class="--bar-chart">
                    <div style="width: <?php echo $browser_stats[3]->percent ?>%; display: inline-block"></div>
                    <h4><?php echo ceil($browser_stats[3]->percent).'%' ?></h4>
                    <div class="--bar-fill" style="width: <?php echo $browser_stats[3]->percent ?>%"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
<?php App::view('partials/dashcharts') ?>
<?php App::view('partials/footer') ?>
