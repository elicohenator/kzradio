<?php

/**
 * Template Name: KZRadio Chart
 * The template for displaying the yearly form for the chart parade
 */

get_header();
?>

<div id="content">
  <div class="chart2020">
    <div id="red-bg-wrapper">
      <div class="chart-container form-wrapper">

        <div class="chart-content" style="display: none;">
          <div class="content">
            <div class="text">
              <p>נסגרה האפשרות לבחור. בואו להקשיב ליום השידורים המיוחד שלנו, בראשון הקרוב מעשר בבוקר עד הלילה</p>
            </div>
          </div>
        </div>

        <div class="chart-content" style="display: block;">
          <form id="ss-form" action="./" method="POST">
            <div class="cols">
              <div>
                <img src="<?= get_template_directory_uri(); ?>/theme/images/chart-24-banner.png" width="420" height="417" alt="לא מצעד שנתי - סיכום שנתי ויום התרמה ברדיו הקצה למשפחות החטופים">
              </div>
              <div class="intro">
                <img src="<?= get_template_directory_uri(); ?>/theme/images/chart-24-button.png" width="382" height="45" alt="31.12.24 - יום ג' - 10:00-22:00">
                <?php the_content(); ?>
              </div>
            </div>
            <div class="mobile-only">
              <img src="<?= get_template_directory_uri(); ?>/theme/images/chart-24-badge-mobile2.png" width="260" height="25" alt="ניתן לבחור עד 23.12.2024 בחצות">
            </div>
            <div class="form-wrapper">
              <img class="mobile-hide" src="<?= get_template_directory_uri(); ?>/theme/images/chart-24-badge.png" width="165" height="251" alt="ניתן לבחור עד 23.12.2024 בחצות">
              <div>
                <img src="<?= get_template_directory_uri(); ?>/theme/images/chart-24-form-title.png" width="500" height="45" alt="סיכום השנה שלך">
                <div class="details">
                  <div class="cols">
                    <p><input type="text" class="ss-q-short kz-req" aria-label="שם פרטי" name="first_name" placeholder="שם פרטי (חובה)" /></p>
                    <p><input type="text" class="ss-q-short kz-req" aria-label="שם משפחה" name="last_name" placeholder="שם משפחה (חובה)" /></p>
                  </div>
                  <div class="cols">
                    <p><input type="text" class="ss-q-short kz-req" aria-label="מייל" name="email" placeholder="אימייל (חובה)" /></p>
                    <p><input type="text" class="ss-q-short kz-req" aria-label="מקום מגורים" name="location" placeholder="עיר/ישוב (חובה)" /></p>
                  </div>
                  <p>&nbsp;</p>
                  <p>
                    <label for="best_song"><strong>שיר השנה שלכםן</strong> (כתבו את שם השיר בסדר הזה: Artist - Song)</label>
                    <input type="text" class="ss-q-short kz-req" name="best_song" placeholder="" />
                  </p>
                  <p>
                    <label for="best_album"><strong>אלבום השנה שלכםן </strong> (כתבו את שם האלבום בסדר הזה: Artist - Album)</label>
                    <input type="text" class="ss-q-short kz-req" name="best_album" placeholder="" />
                  </p>
                  <p>
                    <label for="movie"><strong>סרט השנה שלכםן </strong> (בשיתוף סינמסקופ)</label>
                    <input type="text" class="ss-q-short" name="movie" placeholder="" />
                  </p>
                  <p>
                    <label for="series"><strong>סדרת השנה שלכםן</strong></label>
                    <input type="text" class="ss-q-short" name="series" placeholder="" />
                  </p>
                  <p>
                    <label for="note"><strong>עוד משהו שתרצו לומר לנו?</strong></label>
                    <textarea class="ss-q-short" name="note" data-rows="5"></textarea>
                  </p>
                </div>
                
                <div class="content fields">
                  <div class="text-center" style="width: 100%;">
                    <div class="buttons">
                      <?php wp_nonce_field('register_vote', 'security'); ?>
                      <button id="ss-submit-fake" class="fakeSubmit" type="button" onclick="checkform()">
                        <img class="mobile-hide" src="<?= get_template_directory_uri(); ?>/theme/images/chart-24-submit.png" width="500" height="45" alt="שליחה">
                        <img class="mobile-only" src="<?= get_template_directory_uri(); ?>/theme/images/chart-24-submit-mobile.png" width="310" height="45" alt="שליחה">
                      </button>
                      <button id="ss-submit" type="submit" style="display: none">שלחו</button>
                      <!-- <button id="ss-submit" type="submit">שלח/י</button> -->
                      <iframe id="hidden_iframe" style="display: none"></iframe>
                    </div>
                  </div>
                </div>
              </div>
  
              <div>
                <div class="content text thanks text-center">
                  <p>תודה רבה שבחרת!</p>
                </div>
              </div>
            </div>

            <script>
              function checkform() {
                var req = document.getElementsByClassName('kz-req');
                var good = true;
                for (var i = 0; i != req.length; ++i) {
                  var r = req[i];
                  var bad = r.value.length === 0;
                  r.style.backgroundColor = bad ? "lightcoral" : "mustard";
                  if (good) {
                    if (bad) { // double if because ampersand is problem on ajaxify
                      good = false;
                      r.focus();
                    }
                  }
                }

                if (good) {
                  console.log('good');

                  jQuery.ajax({
                    url: 'https://www.kzradio.net/wp-admin/admin-ajax.php',
                    type: 'post',
                    data: {
                      action: 'register_vote',
                      security: jQuery('#security').val(),
                      song1: jQuery('input[name=song1]').val(),
                      song2: jQuery('input[name=song2]').val(),
                      song3: jQuery('input[name=song3]').val(),
                      song4: jQuery('input[name=song4]').val(),
                      song5: jQuery('input[name=song5]').val(),
                      song6: jQuery('input[name=song6]').val(),
                      song7: jQuery('input[name=song7]').val(),
                      song8: jQuery('input[name=song8]').val(),
                      song9: jQuery('input[name=song9]').val(),
                      song10: jQuery('input[name=song10]').val(),
                      best_song: jQuery('input[name=best_song]').val(),

                      album1: jQuery('input[name=album1]').val(),
                      album2: jQuery('input[name=album2]').val(),
                      album3: jQuery('input[name=album3]').val(),
                      album4: jQuery('input[name=album4]').val(),
                      album5: jQuery('input[name=album5]').val(),
                      album6: jQuery('input[name=album6]').val(),
                      album7: jQuery('input[name=album7]').val(),
                      album8: jQuery('input[name=album8]').val(),
                      album9: jQuery('input[name=album9]').val(),
                      album10: jQuery('input[name=album10]').val(),
                      best_album: jQuery('input[name=best_album]').val(),

                      series: jQuery('input[name=series]').val(),
                      movie: jQuery('input[name=movie]').val(),
                      note: jQuery('textarea[name=note]').val(),

                      first_name: jQuery('input[name=first_name]').val(),
                      last_name: jQuery('input[name=last_name]').val(),
                      email: jQuery('input[name=email]').val(),
                      location: jQuery('input[name=location]').val(),
                    },
                    success: function(response) {
                      console.log(response)
                      console.log('1');
                      jQuery('.buttons').fadeOut(200);
                      jQuery('.send').fadeOut(200);
                      jQuery('.thanks').fadeIn(200);
                    },
                    fail: function(err) {
                      console.log(err)
                      alert('There was an error: ' + err);
                    },
                  });
                }
              }
              // function checkform() {
              //     var req = document.getElementsByClassName('kz-req');var good = true;for (var i = 0; i < req.length; ++i) {var bad = req[i].value.length === 0;req[i].style.backgroundColor = bad ? 'lightcoral' : 'white';if (good && bad) {good = false;req[i].focus();}}if (good) {jQuery('.spaceship').addClass('launch');setTimeout(function() {jQuery('.send').fadeOut(200);jQuery('#ss-submit').click();}, 1000);}
              // }
            </script>
          </form>

          <div class="credits">
            <div>
              <img src="<?= get_template_directory_uri(); ?>/theme/images/logo-kzradio-transparent.png" width="142" height="41" alt="רדיו הקצה kzradio.net">
            </div>
            <div>
              <p><span>עיצוב: <a href="https://www.ellayehudai.com/" target="_blank" rel="nofollow">אלה יהודאי</a></span> <span class="mobile-hide">|</span><span> תכנות: <a href="https://www.elicohenator.xyz" target="_blank" rel="nofollow">אלי כהן</a></span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php get_footer(); ?>