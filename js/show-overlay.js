(function ($, Drupal, drupalSettings) {
  Drupal.behaviors.wutimeAdblockOverlay  = {
    attach: function (context, settings) {

      if (!drupalSettings.wutime_anti_adblock.wutime_anti_adblock_overlay_disable) {

        $(document).ready(function() {
          var re = new RegExp(window.wutimeBotPattern, 'i');
          var badUserAgent = navigator.userAgent;

          // if we can't find ads.js
          // AND the user agent isn't a bot
          // AND we're actually showing an overlay, then show() it
          if (!document.getElementById(btoa(window.wutimeUniqueId)) 
            && !re.test(badUserAgent) 
            && !drupalSettings.wutime_anti_adblock.wutime_anti_adblock_overlay_disable) {
            
            setTimeout(
              function() 
              {            
                // display overlay
                $('#wutime-anti-adblock-overlay', context).once('wutimeAdblockOverlay').show();
                // delay the prompt
              }, drupalSettings.wutime_anti_adblock.wutime_anti_adblock_prompt_delay_secs*1000);     
          }
        });
      }

      // close button
      $(".wutime-close-overlay").click(function () {
          $('#wutime-anti-adblock-overlay').hide();
      });

    }
  };
}(jQuery, Drupal, drupalSettings));
