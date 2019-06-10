(function ($, Drupal, drupalSettings) {
  Drupal.behaviors.wutimeAdBlockNotice = {
    attach: function (context, settings) {    
      $(document).ready(function() {
        var re = new RegExp(window.wutimeBotPattern, 'i');
        var badUserAgent = navigator.userAgent;
        if (!document.getElementById(btoa(window.wutimeUniqueId)) && !re.test(badUserAgent) && drupalSettings.wutime_anti_adblock.wutime_anti_adblock_overlay_disable) {
          $('#block-wutime-anti-adblock-block',context).once('wutimeAdBlockNotice').show();        
        }
      });
    }
  };
}(jQuery, Drupal, drupalSettings));
