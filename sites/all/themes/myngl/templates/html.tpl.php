<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>" version="XHTML+RDFa 1.0" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces; ?>>

<head profile="<?php print $grddl_profile; ?>">
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  <?php print $scripts; ?>
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic' rel='stylesheet' type='text/css'>
  <style>

    div.branded {
      background-color: #53302a;
      color: #a38d50;
    }

    div.branded-secondary {
      background-color:#a38d50;
      color: #53302a;
    }

    .branded ul li.active{
      background-color:#191313;
    }
    .branded ul li.inactive:hover {
      background-color: #a38d50;
    }

    .branded ul li.inactive a {
     color: #a38d50;
     border-right: 1px groove #a38d50;
    }

    .branded ul li.active a {
     color: #53302a;
     border-right: 1px groove #a38d50;
    }


    .branded ul li.inactive a:hover {
      color: #53302a;
    }

    .btn-branded a {
      background-color: #53302a;
      color: #a38d50;
    }

    .btn-branded a:hover {
      background-color: #a38d50;
      color: #53302a;
    }

    .branded-background {
      background-color: #d8c696;
      color: #53302a;
    }

    .branded-tertiary {
      background-color: #e2dbd2;
      color: #53302a;
    }
  </style>
  <?php 
    if (arg(0) == 'myngl' && arg(2) == 'confirmed') :
      $node = node_load(arg(1));

      print '<meta property="og:title" content="'.$node->title.'" />';
      print '<meta property="og:image" content="'.file_create_url($node->field_lounge_background['und'][0]['uri']).'" />';
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
