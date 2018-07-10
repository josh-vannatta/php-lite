<?php

class GoogleAnalytics
{
  protected $analytics;
  protected $profileId;
  protected $constraints;

  public function __construct()
  {
    $client = $this->getClient(__DIR__.'\ga-credentials.json');
    $this->analytics = new Google_Service_AnalyticsReporting($client);
  }

  protected function getClient($credentials)
  {
    $client = new Google_Client();
    $client->setApplicationName("Google Analytics Reporting");
    $client->setAuthConfig($credentials);
    $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
    return $client;
  }

  protected function getProfileId() {
    // Get the list of accounts for the authorized user.
    $accounts = $this->analytics->management_accounts->listManagementAccounts();

    if (count($accounts->getItems()) > 0) {
      $items = $accounts->getItems();
      $firstAccountId = $items[0]->getId();

      // Get the list of properties for the authorized user.
      $properties = $this->analytics->management_webproperties
          ->listManagementWebproperties($firstAccountId);

      if (count($properties->getItems()) > 0) {
        $items = $properties->getItems();
        $firstPropertyId = $items[0]->getId();

        // Get the list of views (profiles) for the authorized user.
        $profiles = $this->analytics->management_profiles
            ->listManagementProfiles($firstAccountId, $firstPropertyId);

        if (count($profiles->getItems()) > 0) {
          $items = $profiles->getItems();

          // Return the first view (profile) ID.
          return $items[0]->getId();

        } else {
          throw new Exception('No views (profiles) found for this user.');
        }
      } else {
        throw new Exception('No properties found for this user.');
      }
    } else {
      throw new Exception('No accounts found for this user.');
    }
  }

  public static function getResults($start_date, $end_date, $metrics, $dimensions = []) {
        // Create the DateRange object.
    $dateRange = new Google_Service_AnalyticsReporting_DateRange();
    $dateRange->setStartDate($start_date);
    $dateRange->setEndDate($end_date);

    // Create the Metrics object.
    $ga_metrics = [];
    foreach ($metrics as $metric) {
      $ga_metric = new Google_Service_AnalyticsReporting_Metric();
      $ga_metric->setExpression("ga:".$metric);
      $ga_metric->setAlias($metric);
      $ga_metrics[] = $ga_metric;
    }

    //Create the Dimensions object.
    $ga_dimensions = [];
    foreach ($dimensions as $dimension) {
      $ga_dimension = new Google_Service_AnalyticsReporting_Dimension();
      $ga_dimension->setName("ga:".$dimension);
      $ga_dimensions[] = $ga_dimension;
    }

    // Create the ReportRequest object.
    $request = new Google_Service_AnalyticsReporting_ReportRequest();
    $request->setViewId("168452398");
    $request->setDateRanges($dateRange);
    $request->setDimensions($ga_dimensions);
    $request->setMetrics($ga_metrics);

    $body = new Google_Service_AnalyticsReporting_GetReportsRequest();
    $body->setReportRequests( array( $request) );
    $self = new static;
    $reports = $self->analytics->reports->batchGet( $body );
    return $self->fetchResults($reports)[0];
  }

  protected function fetchResults($reports)
  {
    $results = [];
    for ( $reportIndex = 0; $reportIndex < count( $reports ); $reportIndex++ ) {
      $result = [];
      $report = $reports[ $reportIndex ];
      $header = $report->getColumnHeader();
      $dimensionHeaders = $header->getDimensions();
      $metricHeaders = $header->getMetricHeader()->getMetricHeaderEntries();
      $rows = $report->getData()->getRows();

      for ( $rowIndex = 0; $rowIndex < count($rows); $rowIndex++) {
        $row = $rows[ $rowIndex ];
        $dimensions = $row->getDimensions();
        $metrics = $row->getMetrics();
        if (count($dimensionHeaders) > 0) {
          for ($i = 0; $i < count($dimensionHeaders) && $i < count($dimensions); $i++) {
            $header = substr($dimensionHeaders[$i], 3);
            $result[$header][$dimensions[$i]] = $this->fetchMetrics($metrics, $metricHeaders);
          }
        } else {
          $result = $this->fetchMetrics($metrics, $metricHeaders);
        }
      }
      $results[$reportIndex] = $result;
    }
    return $results;
  }

  protected function fetchMetrics($metrics, $metricHeaders)
  {
    $metric_values = [];
    for ($j = 0; $j < count($metrics); $j++) {
      $values = $metrics[$j]->getValues();
      for ($k = 0; $k < count($values); $k++) {
        $entry = $metricHeaders[$k];
        $metric_values[$entry->getName()] = $values[$k];
      }
    }
    return $metric_values;
  }

}
