<div role="main" class="main">

  <section class="page-header page-header-classic" style="background: url('<?=base_url()?>main-assets/img/faq.png'); background-position-y: -625px; background-position-x: -111px; padding: 0;
    margin-bottom: 10px;">
    <div style="background: #00000073; padding: 15px 0;">
      <div class="container">
        <div class="row">
          <div class="col p-static">
            <h1 style="font-size: 24px;" data-title-border>FAQ</h1>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="container py-4">

    <div class="row">
      <div class="col-lg-10 col-sm-9" id="main-half">

        <h2 class="font-weight-normal text-7">Frequently Asked <strong class="font-weight-extra-bold">Questions</strong>
        </h2>

        <div class="toggle toggle-primary" data-plugin-toggle>
          <? static $i = 0; foreach($faqs as $faq) { ?>
          <section class="toggle <?=$i == 0 ? 'active' : ''?>">
            <label><?=$faq->question?></label>
            <p><?=$faq->answer?></p>
          </section>
          <? $i++; } ?>
        </div>

      </div>
      <div class="col-sm-3 col-lg-2" style="float: left; margin-bottom: 10px;">
        <div style="border: solid 1px; text-align: center; border-radius: 3px;">
          <p style="margin: 0;">Sponsored Content</p>
          <div class="d-block d-sm-none">
            <script type="text/javascript">
              var ad_idzone = "3530773",
                ad_width = "300",
                ad_height = "100";
            </script>
            <script type="text/javascript" src="https://a.exdynsrv.com/ads.js"></script>
            <noscript><iframe
                src="https://syndication.exdynsrv.com/ads-iframe-display.php?idzone=3530773&output=noscript&type=300x100"
                width="300" height="100" scrolling="no" marginwidth="0" marginheight="0"
                frameborder="0"></iframe></noscript>
          </div>
          <div class="d-none d-sm-block">
            <script type="text/javascript">
              var ad_idzone = "3541645",
                ad_width = "160",
                ad_height = "600";
            </script>
            <script type="text/javascript" src="https://a.exdynsrv.com/ads.js"></script>
            <noscript><iframe
                src="https://syndication.exdynsrv.com/ads-iframe-display.php?idzone=3541645&output=noscript&type=160x600"
                width="160" height="600" scrolling="no" marginwidth="0" marginheight="0"
                frameborder="0"></iframe></noscript>
          </div>
        </div>
      </div>

    </div>

  </div>

</div>