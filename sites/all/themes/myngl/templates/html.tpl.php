<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>" version="XHTML+RDFa 1.0" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces; ?>>

<head profile="<?php print $grddl_profile; ?>">
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  <?php print $scripts; ?>
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic' rel='stylesheet' type='text/css'>

  <?php if (ARG(0)== "myngl-event"): ?>
  <?php
    $nid = ARG(1);
    $n = node_load($nid);
    $brand_id = $n->field_myngl_brand['und'][0][nid];
    $brand = node_load($brand_id);

    $primary_color = $brand->field_brand_primary_color['und'][0]['rgb'];
    $secondary_color = $brand->field_brand_secondary_color['und'][0]['rgb'];
    $background_color = $brand->field_brand_background_color['und'][0]['rgb'];
    $tertiary_color = $brand->field_brand_tertiary_color['und'][0]['rgb'];

  ?>
  <style>


      div.branded {
        background-color:<?php print $primary_color; ?>;
        color: <?php print $secondary_color; ?>;
      }

      div.branded-secondary {
        background-color:<?php print $secondary_color; ?>;
        color: <?php print $primary_color; ?>;
      }

      .branded ul li.active{
        background-color:<?php print $tertiary_color;?>;
      }
      .branded ul li.inactive:hover {
        background-color: <?php print $secondary_color; ?>;
      }

      .branded ul li.inactive a {
       color: <?php print $secondary_color; ?>;
       border-right: 1px groove <?php print $secondary_color; ?>;
      }

      .branded ul li.active a {
       color: <?php print $primary_color; ?>;
       border-right: 1px groove <?php print $secondary_color; ?>;
      }


      .branded ul li.inactive a:hover {
        color: <?php print $primary_color; ?>;
      }

      .btn-branded a {
        background-color: <?php print $primary_color; ?>;
        color: <?php print $secondary_color; ?>;
      }

      .btn-branded a:hover {
        background-color: <?php print $secondary_color; ?>;
        color: <?php print $primary_color; ?>;
      }

      .branded-background {
        background-color: #d8c696;
        color: <?php print $primary_color; ?>;
      }

      .branded-tertiary {
        background-color: <?php print $background_color; ?>;
        color: <?php print $primary_color; ?>;
      }




    #help-overlay-inner{
      position:absolute;
      z-index:300;
      left:0;
      right:0;
      height:500px;
      width:800px;
      margin-left:auto;
      margin-right:auto;
      background-color:<?php print $background_color; ?>;
      border:solid 20px <?php print $primary_color; ?>;
      border-top: solid 35px <?php print $primary_color; ?>;
      overflow: scroll;
    }
    #help-overlay-close{
      position:absolute;
      right:-10px;
      top:10px;
      z-index:1000;
      color:#cccccc;
    }
    #help-title{
      color: <?php print $secondary_color; ?>;
      font-size:30px;
      font-family:"georgia";
      margin-left:20px;
      margin-top:20px;

    }
    #help-overlay-inner ol li{
      margin-bottom:10px;
    }

    #help-overlay-inner .short-line{
      width:50px;
      height:1px;
      border-top:2px #555555 solid;
      margin-left:20px;
      margin-top:10px;
    }


    </style>
  <? endif; ?>
  <?php 
    if (arg(0) == 'myngl' && arg(2) == 'confirmed') :
      $node = node_load(arg(1));

      print '<meta property="og:title" content="'.$node->title.'" />';
      if (isset($node->field_lounge_background['und'])){
        print '<meta property="og:image" content="'.file_create_url($node->field_lounge_background['und'][0]['uri']).'" />';
      }
      print '<meta property="og:description" content="You friend is attending a really cool invite-only “Online Experiential Event” – '.$node->title.' – Socializing, Privileged Access Content and FREE “Gift Bags!!”. To find out more and get invited to other Myngls go to theMyngl.com" />';
    endif; 
  ?>
</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?>>

  <div id="skip-link">
    <a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
  </div>


  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
  <div id="overlay-background"></div>

</body>
</html>
