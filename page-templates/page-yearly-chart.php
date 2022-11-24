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
      <div class="chart-mobile-bg">
        <div class="chart-bg-top">
          <img src="<?php echo get_template_directory_uri(); ?>/theme/images/chart_22_top.png')" alt="המצעד האלטרנטיבי השנתי של רדיו הקצה">
        </div>
        <div class="chart-bg-center"></div>
        <div class="chart-bg-bottom">
          <img src="<?php echo get_template_directory_uri(); ?>/theme/images/chart_22_bottom.png')" alt="">
        </div>
      </div>
      <div class="chart-container form-wrapper">
        <div class="chart-content">
          <form id="ss-form" action="./" method="POST">
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
                <h2 class="songs-title" data-content="שירי השנה">שירי השנה</h2>
                <ul class="notes">
                  <li>חובה לבחור לפחות שיר אחד.</li>
                  <li>אין משמעות לסדר הבחירה, לכל בחירה משקל שווה.</li>
                  <li>בחרו רק את מה שאתם אוהבים ואוהבות.</li>
                  <li>הקפידו לרשום את השירים כך: Artist - Song</li>
                </ul>
                <table style="width:100%">
                  <tr>
                    <td>1.</td>
                    <td><input type="text" class="ss-q-short kz-req" aria-td="שיר 1 - אמן" name="song1" placeholder="שדה חובה" /></td>
                  </tr>
                  <tr>
                    <td>2.</td>
                    <td><input type="text" class="ss-q-short" aria-td="שיר 2 - אמן" name="song2" /> </td>
                  </tr>
                  <tr>
                    <td>3.</td>
                    <td><input type="text" class="ss-q-short" aria-td="שיר 3 - אמן" name="song3" /> </td>
                  </tr>
                  <tr>
                    <td>4.</td>
                    <td><input type="text" class="ss-q-short" aria-td="שיר 4 - אמן" name="song4" /></td>
                  </tr>
                  <tr>
                    <td>5.</td>
                    <td><input type="text" class="ss-q-short" aria-td="שיר 5 - אמן" name="song5" /> </td>
                  </tr>
                  <tr>
                    <td>6.</td>
                    <td><input type="text" class="ss-q-short" aria-td="שיר 6 - אמן" name="song6" /></td>
                  </tr>
                  <tr>
                    <td>7.</td>
                    <td><input type="text" class="ss-q-short" aria-td="שיר 7 - אמן" name="song7" /> </td>
                  </tr>
                  <tr>
                    <td>8.</td>
                    <td><input type="text" class="ss-q-short" aria-td="שיר 8 - אמן" name="song8" /></td>
                  </tr>
                  <tr>
                    <td>9.</td>
                    <td><input type="text" class="ss-q-short" aria-td="שיר 9 - אמן" name="song9" /> </td>
                  </tr>
                  <tr>
                    <td>10.</td>
                    <td><input type="text" class="ss-q-short" aria-td="שיר 10 - אמן" name="song10" /></td>
                  </tr>
                </table>
                <p>אם הייתם בוחרים רק שיר אחד מהרשימה שעשיתם - שיר השנה שלכם הוא: </p>
                <input type="text" class="ss-q-short kz-req" aria-td="שיר השנה - אמן" name="best_song" placeholder="שדה חובה" />
              </div>

              <div id="albums-wrapper">
                <h2 class="albums-title" data-content="אלבומי השנה">אלבומי השנה</h2>
                <ul class="notes">
                  <li>חובה לבחור לפחות אלבום אחד.</li>
                  <li>אין משמעות לסדר הבחירה, לכל בחירה משקל שווה.</li>
                  <li>בחרו רק את מה שאתם אוהבים ואוהבות.</li>
                  <li>הקפידו לרשום את האלבומים כך: Artist - Album</li>
                </ul>
                <table style="width:100%">
                  <tr>
                    <td>1.</td>
                    <td><input type="text" class="ss-q-short kz-req" aria-td="אלבום 1 - אמן" name="album1" placeholder="שדה חובה" />
                  </tr>
                  <tr>
                    <td>2.</td>
                    <td><input type="text" class="ss-q-short" aria-td="אלבום 2 - אמן" name="album2" /> </td>
                  </tr>
                  <tr>
                    <td>3.</td>
                    <td><input type="text" class="ss-q-short" aria-td="אלבום 3 - אמן" name="album3" /> </td>
                  </tr>
                  <tr>
                    <td>4.</td>
                    <td><input type="text" class="ss-q-short" aria-td="אלבום 4 - אמן" name="album4" /> </td>
                  </tr>
                  <tr>
                    <td>5.</td>
                    <td><input type="text" class="ss-q-short" aria-td="אלבום 5 - אמן" name="album5" /> </td>
                  </tr>
                  <tr>
                    <td>6.</td>
                    <td><input type="text" class="ss-q-short" aria-td="אלבום 6 - אמן" name="album6" /> </td>
                  </tr>
                  <tr>
                    <td>7.</td>
                    <td><input type="text" class="ss-q-short" aria-td="אלבום 7 - אמן" name="album7" /> </td>
                  </tr>
                  <tr>
                    <td>8.</td>
                    <td><input type="text" class="ss-q-short" aria-td="אלבום 8 - אמן" name="album8" /> </td>
                  </tr>
                  <tr>
                    <td>9.</td>
                    <td><input type="text" class="ss-q-short" aria-td="אלבום 9 - אמן" name="album9" /> </td>
                  </tr>
                  <tr>
                    <td>10.</td>
                    <td><input type="text" class="ss-q-short" aria-td="אלבום 10 - אמן" name="album10" /> </td>
                  </tr>
                </table>
                <p>אם הייתם בוחרים רק אלבום אחד מהרשימה שעשיתם - אלבום השנה שלכם הוא:</p>
                <input type="text" class="ss-q-short kz-req" aria-td="אלבום השנה - אמן" name="best_album" placeholder="שדה חובה" />
              </div>

              <div class="side right">
                <p>סרט השנה (בשיתוף סינמסקופ):</p>
                <input type="text" class="ss-q-short" name="movie" />

                <p>סדרת הטלוויזיה של השנה:</p>
                <input type="text" class="ss-q-short" name="series" />
              </div>

              <div class="side left">
                <p>עוד משהו שתרצו לומר?</p>
                <textarea class="ss-q-short" name="note" data-rows="5"></textarea>
                <br>
                <div class="text-center">
                  <!--<h3 class="fakeSubmit">שליחה</h3>-->
                  <div class="buttons">
                    <!--<button id="ss-submit-fake" class="fakeSubmit" type="button" onclick="var req = document.getElementsByClassName('kz-req');var good = true;for (var i = 0; i < req.length; ++i) {var bad = req[i].value.length === 0;req[i].style.backgroundColor = bad ? 'lightcoral' : 'white';if (good && bad) {good = false;req[i].focus();}}console.log('good='+good); if (good) {setTimeout(function() {jQuery('.send').fadeOut(200);jQuery('#ss-form').submit();}, 1000);}">שליחה</button> -->
                    <?php wp_nonce_field('register_vote', 'security'); ?>
                    <button id="ss-submit-fake" class="fakeSubmit" type="button" onclick="checkform()" data-content="שלח/י">שלח/י</button>
                    <button id="ss-submit" type="submit" style="display: none">שלחו</button>
                    <!-- <button id="ss-submit" type="submit">שלח/י</button> -->
                    <iframe id="hidden_iframe" style="display: none"></iframe>
                  </div>
                </div>

              </div>

              <div class="send text text-center">
                <p class="strong red outline-text" data-content="אנחנו מחלקים בין כל מי שישתף את סרטון ההצבעה שלנו בפייסבוק:">אנחנו מחלקים בין כל מי שישתף את סרטון ההצבעה שלנו בפייסבוק:</p>
                <p class="strong">כרטיס לפסטיבל פרימוורה 2022!</p>
                <p>כל מה שתצטרכו לעשות כדי להיכנס לתחרות על הפרסים, הוא לשתף את <a href="https://www.facebook.com/watch/?v=655743805426659" target="_blank">הפוסט הבא</a> בפייסבוק ולכתוב לנו בקומנטס מדוע לדעתכם מגיע לכם/ן לזכות בכרטיס, ואולי תזכו. על ידי השתתפות בפעילות אתם מאשרים כי קראתם את <a href="https://docs.google.com/document/d/e/2PACX-1vT5MmDWoFT2L1qH4_5JW2NZgbCm_lVPHAoJ9rpafNX8dRLGErYolJf7jprnH2oPjumEElTIbnQQuG7-/pub" target="_blank">התקנון</a>. בהצלחה!</p>
                <p>המצעד האלטרנטיבי השנתי של רדיו הקצה ישודר ביום ראשון 26.12.21 ,החל מ-10:00 בבוקר ועד 22:00 ברדיו הקצה - לו ניתן להאזין 24/7 פה: <a href="https://www.kzradio.net/">KZRADIO.NET</a> ובשלל אפליקציות הרדיו.</p>
              </div>

              <div class="content text thanks text-center">
                <p class="strong red">תודה רבה שהצבעת למצעד האלטרנטיבי השנתי של רדיו הקצה!</p>
                <p>
                  את המצעד נשדר ביום ראשון, 26.12, מ-10:00 בבוקר עד 22:00.<br>
                  עד אז אפשר לשמוע את סיכומי השנה ואת שלל התכניות של השדרניות והשדרנים שלנו, וגם לקרוא את סיכומי השנה במגזין שלנו. הכל בכתובת: <a href="https://www.kzradio.net/">KZRADIO.NET</a>
                </p>
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