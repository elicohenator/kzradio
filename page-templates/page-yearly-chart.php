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

        <img src="<?= get_template_directory_uri(); ?>/theme/images/chart_23_top2.png" alt="באנר ראשי!">

        <div class="chart-content" style="display: none;">
          <div class="content">
            <div class="text">
              <p class="strong">נסגרה האפשרות להצביע!</p>
              <p>המצעד האלטרנטיבי השנתי 2022 על כל תוצאותיו ישודר בראשון 25.12.22 החל מ10:00 בבוקר ועד 22:00 ברדיו הקצה. עד אז עדיין אפשר לשתף את <a href="https://tinyurl.com/2w4rpexe" target="_blank">הוידאו הזה</a>, לענות בגוף הפוסט על השאלה ששאלנו בו, ולנסות לזכות בכרטיס VIP לפסטיבל פרימוורה 2023 בברצלונה כולל טיסות ומלון - מתנת וורנר מיוזיק, או באחד משני כרטיסים לפסטיבל אינדינגב 2023 או באחד משני שוברים על סך 500 ש"ח לקניית תקליטים באוזן השלישית. בהצלחה ונשתמע במצעד</p>
            </div>
          </div>
        </div>

        <div class="chart-content" style="display: block;">
          <form id="ss-form" action="./" method="POST">
            <div>
              <p>
                השנה החלטנו לא לעשות מצעד כרגיל.<br>
                מצעד מרגיש לנו חגיגי מדי כרגע. אבל אנחנו כן רוצים לעשות יום שידורים מיוחד בו נסכם את המוזיקה של השנה, עם האלבומים והשירים שהכי אהבתםן, ועם אלה שאנחנו הכי אהבנו. <br>
                לא נעשה דירוג כרגיל, אבל נודיע במהלך היום מהם השיר והאלבום שקיבלו הכי הרבה קולות. <br>
                וחשוב הרבה יותר מהכל - זה יהיה יום התרמה למשפחות החטופים.
              </p>
            </div>

            <img src="<?= get_template_directory_uri(); ?>/theme/images/chart_23_link2.png" alt="לינק להתרמה בקרוב!">

            <div class="details">
              <table style="width:100%">
                <tr>
                  <td style="padding-left: 5px;"><input type="text" class="ss-q-short kz-req" aria-label="שם פרטי" name="first_name" placeholder="שם פרטי (חובה)" /></td>
                  <td style="padding-left: 5px;"><input type="text" class="ss-q-short kz-req" aria-label="שם משפחה" name="last_name" placeholder="שם משפחה (חובה)" /></td>
                  <td style="padding: 0 5px;"><input type="text" class="ss-q-short kz-req" aria-label="מייל" name="email" placeholder="אימייל (חובה)" /></td>
                  <td style="padding-right: 5px;"><input type="text" class="ss-q-short kz-req" aria-label="מקום מגורים" name="location" placeholder="עיר/ישוב (חובה)" /></td>
                </tr>
              </table>
            </div>

            <div class="content fields">
              <div id="songs-wrapper">
                <h2 class="songs-title" data-content="בחרו את שיר השנה שלכם">בחרו את שיר השנה שלכם</h2>
                <input type="text" class="ss-q-short kz-req" aria-td="שיר השנה - אמן" name="best_song" placeholder="" />
              </div>

              <div id="albums-wrapper">
                <h2 class="albums-title" data-content="בחרו את אלבום השנה שלכם">בחרו את אלבום השנה שלכם</h2>
                <input type="text" class="ss-q-short kz-req" aria-td="אלבום השנה - אמן" name="best_album" placeholder="" />
              </div>

              <div style="width: 100%; text-align: center;">
                <p>
                  בבקשה אל תבחרו יותר משיר אחד ואלבום אחד.
                </p>
                <hr style="border-color: #433f41; margin: 1em 0;">
              </div>

              <div class="text-center" style="width: 100%;">
                <p>עוד משהו שתרצו לומר?</p>
                <textarea class="ss-q-short" name="note" data-rows="5" style="max-width: 480px; margin-left: auto; margin-right: auto;"></textarea>


                <div class="buttons">
                  <?php wp_nonce_field('register_vote', 'security'); ?>
                  <button id="ss-submit-fake" class="fakeSubmit" type="button" onclick="checkform()" data-content="שלח/י">שלח/י</button>
                  <button id="ss-submit" type="submit" style="display: none">שלחו</button>
                  <!-- <button id="ss-submit" type="submit">שלח/י</button> -->
                  <iframe id="hidden_iframe" style="display: none"></iframe>
                </div>
              </div>
            </div>

            <img src="<?= get_template_directory_uri(); ?>/theme/images/chart_23_rope3.png" alt="יום התרמה">

            <div>
              <div class="send text text-center">
                <p class="strong red">ניתן להצביע עד יום רביעי, ה-24.12.2023 בחצות</p>
              </div>

              <div class="content text thanks text-center">
                <p class="strong red">תודה רבה שבחרת!</p>
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
        </div>
      </div>
    </div>
  </div>
</div>


<?php get_footer(); ?>