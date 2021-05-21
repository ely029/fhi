<div class="section">
  <div class="section__top">
    <div class="section__top-text">
      <h1 class="section__title">Reports</h1>
      <div class="breadcrumbs"><a class="breadcrumbs__link">Reports</a><a class="breadcrumbs__link"></a><a class="breadcrumbs__link"></a></div>
    </div>
    <div class="section__top-menu">
      <input class="section__top-trigger" type="checkbox" />
      <div class="section__top-icon"><span> </span><span> </span><span> </span></div>
      <span class="section__top-popup"><img class="image image--warning" src="src/img/icon-warning.png" alt="warning icon" /><span>Report issue</span></span>
    </div>
  </div>
  <div class="modal" id="reportIssue" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal__background" data-dismiss="modal"></div>
    <div class="modal__container">
      <div class="modal__box">
        <h2 class="modal__title">Report issue</h2>
        <p class="modal__text">Please elaborate on the issue encountered,</p>
        <form class="form form--full">
          <div class="form__content"><textarea class="form__input form__input--message" placeholder="Enter issue"></textarea><label class="form__label" for="">Report issue</label></div>
        </form>
        <div class="modal__button modal__button--end"><input class="button" type="submit" value="Submit" /></div>
      </div>
    </div>
  </div>
  <div class="section__container">
    <form class="form" action="">
      <ul class="card card--reverse">
        <li class="card__item">
          <div class="grid grid--two">
            <h2 class="section__heading">Period</h2>
            <h2 class="section__heading">Location</h2>
          </div>
          <div class="grid grid--two grid--start">
            <div class="grid grid--column">
              <ul class="form__group form__group--reports">
                <li class="form__group-item">
                  <label class="form__sublabel" for="period">Quarterly<input class="form__trigger" type="radio" name="period" /><span class="form__radio"></span></label>
                </li>
                <li class="form__group-item">
                  <label class="form__sublabel" for="period">Monthly<input class="form__trigger" type="radio" name="period" /><span class="form__radio"></span></label>
                </li>
                <li class="form__group-item">
                  <label class="form__sublabel" for="period">Annual<input class="form__trigger" type="radio" name="period" /><span class="form__radio"></span></label>
                </li>
              </ul>
              <div class="grid grid--two grid--full grid--start">
                <div class="form__content">
                  <select class="form__input form__input--select js-year"></select>
                  <div class="triangle triangle--down"></div>
                  <label class="form__label" for="">Year</label>
                </div>
                <div class="form__content">
                  <select class="form__input form__input--select">
                    <option>1st Quarter</option>
                  </select>
                  <div class="triangle triangle--down"></div>
                  <label class="form__label" for="">Quarter</label>
                </div>
              </div>
            </div>
            <div class="grid grid--half grid--column">
              <div class="form__content">
                <select class="form__input form__input--select">
                  <option value="Metro Manila">Metro Manila</option>
                  <option value="Abra">Abra</option>
                  <option value="Agusan del Norte">Agusan del Norte</option>
                  <option value="Agusan del Sur">Agusan del Sur</option>
                  <option value="Aklan">Aklan</option>
                  <option value="Albay">Albay</option>
                  <option value="Antique">Antique</option>
                  <option value="Apayao">Apayao</option>
                  <option value="Aurora">Aurora</option>
                  <option value="Basilan">Basilan</option>
                  <option value="Bataan">Bataan</option>
                  <option value="Batanes">Batanes</option>
                  <option value="Batangas">Batangas</option>
                  <option value="Biliran">Biliran</option>
                  <option value="Benguet">Benguet</option>
                  <option value="Bohol">Bohol</option>
                  <option value="Bukidnon">Bukidnon</option>
                  <option value="Bulacan">Bulacan</option>
                  <option value="Cagayan">Cagayan</option>
                  <option value="Camarines Norte">Camarines Norte</option>
                  <option value="Camarines Sur">Camarines Sur</option>
                  <option value="Camiguin">Camiguin</option>
                  <option value="Capiz">Capiz</option>
                  <option value="Catanduanes">Catanduanes</option>
                  <option value="Cavite">Cavite</option>
                  <option value="Cebu">Cebu</option>
                  <option value="Compostela">Compostela</option>
                  <option value="Davao del Norte">Davao del Norte</option>
                  <option value="Davao del Sur">Davao del Sur</option>
                  <option value="Davao Oriental">Davao Oriental</option>
                  <option value="Eastern Samar">Eastern Samar</option>
                  <option value="Guimaras">Guimaras</option>
                  <option value="Ifugao">Ifugao</option>
                  <option value="Ilocos Norte">Ilocos Norte</option>
                  <option value="Ilocos Sur">Ilocos Sur</option>
                  <option value="Iloilo">Iloilo</option>
                  <option value="Isabela">Isabela</option>
                  <option value="Kalinga">Kalinga</option>
                  <option value="Laguna">Laguna</option>
                  <option value="Lanao del Norte">Lanao del Norte</option>
                  <option value="Lanao del Sur">Lanao del Sur</option>
                  <option value="La Union">La Union</option>
                  <option value="Leyte">Leyte</option>
                  <option value="Maguindanao">Maguindanao</option>
                  <option value="Marinduque">Marinduque</option>
                  <option value="Masbate">Masbate</option>
                  <option value="Mindoro Occidental">Mindoro Occidental</option>
                  <option value="Mindoro Oriental">Mindoro Oriental</option>
                  <option value="Misamis Occidental">Misamis Occidental</option>
                  <option value="Misamis Oriental">Misamis Oriental</option>
                  <option value="Mountain Province">Mountain Province</option>
                  <option value="Negros Occidental">Negros Occidental</option>
                  <option value="Negros Oriental">Negros Oriental</option>
                  <option value="North Cotabato">North Cotabato</option>
                  <option value="Northern Samar">Northern Samar</option>
                  <option value="Nueva Ecija">Nueva Ecija</option>
                  <option value="Nueva Vizcaya">Nueva Vizcaya</option>
                  <option value="Palawan">Palawan</option>
                  <option value="Pampanga">Pampanga</option>
                  <option value="Pangasinan">Pangasinan</option>
                  <option value="Quezon">Quezon</option>
                  <option value="Quirino">Quirino</option>
                  <option value="Rizal">Rizal</option>
                  <option value="Romblon">Romblon</option>
                  <option value="Samar">Samar</option>
                  <option value="Sarangani">Sarangani</option>
                  <option value="Siquijor">Siquijor</option>
                  <option value="Sorsogon">Sorsogon</option>
                  <option value="South Cotabato">South Cotabato</option>
                  <option value="Southern Leyte">Southern Leyte</option>
                  <option value="Sultan Kudarat">Sultan Kudarat</option>
                  <option value="Sulu">Sulu</option>
                  <option value="Surigao del Norte">Surigao del Norte</option>
                  <option value="Surigao del Sur">Surigao del Sur</option>
                  <option value="Tarlac">Tarlac</option>
                  <option value="Tawi-Tawi">Tawi-Tawi</option>
                  <option value="Zambales">Zambales</option>
                  <option value="Zamboanga del Norte">Zamboanga del Norte</option>
                  <option value="Zamboanga del Sur">Zamboanga del Sur</option>
                  <option value="Zamboanga Sibugay">Zamboanga Sibugay</option>
                </select>
                <div class="triangle triangle--down"></div>
                <label class="form__label" for="">Province</label>
              </div>
              <div class="form__content">
                <select class="form__input form__input--select">
                  <option>sample</option>
                </select>
                <div class="triangle triangle--down"></div>
                <label class="form__label" for="">Health facility</label>
              </div>
            </div>
          </div>
          <div class="form__button form__button--end"><input class="button" type="button" value="Apply" /></div>
        </li>
        <li class="card__item">
          <div class="grid grid--start">
            <div class="form__content">
              <span class="form__text">1st Quarter 2021 </span>
              <h2 class="section__heading">Summary</h2>
            </div>
            <a class="button" href="">Export </a>
          </div>
          <div class="grid">
            <div class="form__content"><span class="form__text">Cabanatuan</span><label class="form__label">Province</label></div>
            <div class="form__content"><span class="form__text">All</span><label class="form__label">Health facility</label></div>
            <div class="form__content"><span class="form__text">June 10, 2021</span><label class="form__label">Date generated</label></div>
            <div class="form__content"><span class="form__text">firstname lastname</span><label class="form__label">Prepared by</label></div>
          </div>
          <div class="grid grid--three grid--start">
            <div class="grid grid--column">
              <table class="table table--reports table--full">
                <thead>
                  <tr>
                    <th class="table__head">Total cases presented to R-TB MAC</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="table__details">12,345</td>
                  </tr>
                </tbody>
              </table>
              <table class="table table--reports table--full">
                <thead>
                  <tr>
                    <th class="table__head">No. of cases resolved by R-TB MAC</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="table__details">12,345</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="grid grid--column"><canvas class="chart" id="chartPresented"> </canvas><canvas class="chart" id="chartSex"></canvas></div>
            <div class="grid grid--column"><canvas class="chart" id="chartStatus"></canvas><canvas class="chart" id="chartAge"></canvas></div>
          </div>
        </li>
        <li class="card__item">
          <h2 class="section__heading section__heading--full">Breakdown of all cases presented to R-TB MAC by resolution [quarter] [year]</h2>
          <table class="table table--reports">
            <thead>
              <tr>
                <th class="table__head">Reason for Presentation to</th>
                <th class="table__head">Resolved</th>
                <th class="table__head">Not Resolved</th>
                <th class="table__head">Total</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="table__details">Enrollment</td>
                <td class="table__details"></td>
                <td class="table__details"></td>
                <td class="table__details"></td>
              </tr>
              <tr>
                <td class="table__details">Case Management</td>
                <td class="table__details"></td>
                <td class="table__details"></td>
                <td class="table__details"></td>
              </tr>
              <tr>
                <td class="table__details">Treatment Outcome</td>
                <td class="table__details"></td>
                <td class="table__details"></td>
                <td class="table__details"></td>
              </tr>
              <tr>
                <td class="table__details">Total</td>
                <td class="table__details table__details--green">2121</td>
                <td class="table__details table__details--green">2121</td>
                <td class="table__details table__details--green">2121</td>
              </tr>
            </tbody>
          </table>
        </li>
        <li class="card__item">
          <h2 class="section__heading section__heading--full">Breakdown of all cases presented to R-TB MAC by age and sex [quarter] [year]</h2>
          <table class="table table--reports">
            <thead>
              <tr>
                <th class="table__head table__head--white"></th>
                <th class="table__head" colspan="2">Children &lt; 15 years old</th>
                <th class="table__head" colspan="2">Adults ≥ 15 years old</th>
                <th class="table__head" colspan="2">Total</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th class="table__head">Reason for presentation</th>
                <th class="table__head">M</th>
                <th class="table__head">F</th>
                <th class="table__head">M</th>
                <th class="table__head">F</th>
                <th class="table__head">M</th>
                <th class="table__head">F</th>
              </tr>
              <tr>
                <td class="table__details">Enrollment</td>
                <td class="table__details"></td>
                <td class="table__details"></td>
                <td class="table__details"></td>
                <td class="table__details"></td>
                <td class="table__details"></td>
                <td class="table__details"></td>
              </tr>
              <tr>
                <td class="table__details">Case Management</td>
                <td class="table__details"></td>
                <td class="table__details"></td>
                <td class="table__details"></td>
                <td class="table__details"></td>
                <td class="table__details"></td>
                <td class="table__details"></td>
              </tr>
              <tr>
                <td class="table__details">Treatment Outcome</td>
                <td class="table__details"></td>
                <td class="table__details"></td>
                <td class="table__details"></td>
                <td class="table__details"></td>
                <td class="table__details"></td>
                <td class="table__details"></td>
              </tr>
              <tr>
                <td class="table__details">Total</td>
                <td class="table__details table__details--green">55</td>
                <td class="table__details table__details--green">55</td>
                <td class="table__details table__details--green">55</td>
                <td class="table__details table__details--green">55</td>
                <td class="table__details table__details--green">55</td>
                <td class="table__details table__details--green">55</td>
              </tr>
            </tbody>
          </table>
        </li>
        <li class="card__item">
          <h2 class="section__heading section__heading--full">Summary cases presented to N-TB MAC</h2>
          <div class="grid grid--three grid--start">
            <div class="grid grid--column">
              <table class="table table--reports table--full">
                <thead>
                  <tr>
                    <th class="table__head">Cases unresolved by R-TB MAC</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="table__details">12,345</td>
                  </tr>
                </tbody>
              </table>
              <table class="table table--reports table--full">
                <thead>
                  <tr>
                    <th class="table__head">Cases presented to N-TB MAC</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="table__details">12,345</td>
                  </tr>
                </tbody>
              </table>
              <table class="table table--reports table--full">
                <thead>
                  <tr>
                    <th class="table__head">Cases resolved by N-TB MAC</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="table__details">12,345</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="grid"><canvas class="chart" id="chartCasesPresented"></canvas></div>
            <div class="grid"><canvas class="chart" id="chartCasesStatus"></canvas></div>
          </div>
        </li>
        <li class="card__item">
          <h2 class="section__heading section__heading--full">Breakdown of cases presented to N-TB MAC by resolution [quarter] [year]</h2>
          <table class="table table--reports">
            <thead>
              <tr>
                <th class="table__head">Reason for Presentation to</th>
                <th class="table__head">Resolved</th>
                <th class="table__head">Not Resolved</th>
                <th class="table__head">Total</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="table__details">Enrollment</td>
                <td class="table__details"></td>
                <td class="table__details"></td>
                <td class="table__details"></td>
              </tr>
              <tr>
                <td class="table__details">Case Management</td>
                <td class="table__details"></td>
                <td class="table__details"></td>
                <td class="table__details"></td>
              </tr>
              <tr>
                <td class="table__details">Treatment Outcome</td>
                <td class="table__details"></td>
                <td class="table__details"></td>
                <td class="table__details"></td>
              </tr>
              <tr>
                <td class="table__details">Total</td>
                <td class="table__details table__details--green">2121</td>
                <td class="table__details table__details--green">2121</td>
                <td class="table__details table__details--green">2121</td>
              </tr>
            </tbody>
          </table>
        </li>
        <li class="card__item">
          <h2 class="section__heading">Other info</h2>
          <table class="table table--reports table--half">
            <tbody>
              <tr>
                <th class="table__head">R-TB MAC Average Turnaround Time</th>
                <td class="table__details">666</td>
              </tr>
              <tr>
                <th class="table__head">N-TB MAC Average Turnaround Time</th>
                <td class="table__details">666</td>
              </tr>
              <tr>
                <th class="table__head">Average no. of Presentations per week</th>
                <td class="table__details">666</td>
              </tr>
              <tr>
                <th class="table__head">Average no. of Presentations per month</th>
                <td class="table__details">666</td>
              </tr>
            </tbody>
          </table>
        </li>
      </ul>
    </form>
  </div>
</div>