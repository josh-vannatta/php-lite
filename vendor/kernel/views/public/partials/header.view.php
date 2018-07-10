<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $page_title; ?></title>
    <!-- Google Analytics -->
    <script type="text/javascript" async="" src="https://www.google-analytics.com/analytics.js"></script>
    <!-- Meta: SEO, Context, Charset, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="<?php echo $page_description; ?>">
    <meta name="robots" content="index,follow,noodp">
    <meta name="google" content="nositelinkssearchbox">
    <meta name="google" content="notranslate">
    <meta name="google-site-verification" content="verification_token">
    <meta name="subject" content="Neuraptive">
    <meta name="url" content="">
    <meta name="directory" content="Medical Technology">
    <meta name="rating" content="General">
    <meta name="referrer" content="no-referrer">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="x-dns-prefetch-control" content="off">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/image/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/image/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/image/favicon/favicon-16x16.png">
    <link rel="manifest" href="/assets/image/favicon/manifest.json">
    <link rel="mask-icon" href="/assets/image/favicon/safari-pinned-tab.svg" color="#be2021">
    <link rel="shortcut icon" href="/assets/image/favicon/favicon.ico">
    <meta name="msapplication-config" content="/assets/image/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <!-- CSS, JS Libraries -->
    <link rel="stylesheet" href="/assets/css/simple-line-icons.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Saira:100,300,400,500,600,700|Audiowide" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/master.css">
    <script type="text/javascript" rel="javascript" src="/assets/js/city_state.js"></script>
    <script type="text/javascript" rel="javascript" src="/assets/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" rel="javascript" src="/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" rel="javascript" src="/assets/js/xBrowser.js"></script>
    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-113001300-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-113001300-1');
    </script>
  </head>
  <body>
    <!-- Header Navigation -->
    <?php App::view('public/partials/nav') ?>
    <!-- Page Container -->
    <div id="page-container" class="page-container">
      <!-- Hero Banner -->
      <section id="hero-section" class="hero-section">
        <div id="hero-container" class="hero-container">
          <!-- <div id="hero-banner" class="{{page.heroclass}} parallax-full"></div> -->
          <div id="hero-banner" class="alt-standard-banner"></div>
            <div class="cover-all banner-background-full"></div>
            <div class="navlower-track banner-track"></div>
            <div class="cover-all banner-content-wrapper padding-xl no-padding-top no-padding-bottom" style="z-index: 2">
              <div class="wide-rule full-height">
                <div class="banner-content-container">
                  <h1 class="standardbanner-content banner-header"><?= $title ?></h1>
                  <nav class="breadcrumbs">
                    <?php $i = count($crumbs); ?>
                    <?php foreach ($crumbs as $link => $name): ?>
                      <a href="<?= $link ?>"><?= $name ?></a>
                      <?php if (--$i > 0): ?>
                        <i class="material-icons breadcrumbs-arrow">/</i>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  </nav>
                </div>
              </div>
            </div>
        </div>
      </section>
