<div class="form__tab step-2">
    <h2 class="section__heading">Bacteriological results and status</h2>
    <div class="form__container">
      <table class="table table--unset js-table-unset">
        <thead>
          <tr>
            <th class="table__head"></th>
            <th class="table__head">Date collected</th>
            <th class="table__head">Method used</th>
            <th class="table__head">Resistance pattern</th>
          </tr>
        </thead>
        <tbody>
        @php
            $bacteriologicalResults = $tbMacForm->treatmentOutcomeBacteriologicalResults;
            $screenings = $bacteriologicalResults->filter(function($item){
                return $item->type == 'screenings';
            });
            $lpa = $bacteriologicalResults->filter(function($item){
                return $item->type == 'lpa';
            })->first();
            $dst = $bacteriologicalResults->filter(function($item){
                return $item->type == 'dst';
            })->first();
            $monthlyScreenings = $bacteriologicalResults->filter(function($item){
                return $item->type == 'monthly_screenings';
            })->values();

        @endphp
          <tr class="table__row form-step-2">
            <td class="table__details">Screening 1</td>
            <td class="table__details form-group">
              <input class="form__input form__input--full" type="date" name="screening_1_date_collected" required value="{{ $screenings[0]->date_collected->format('Y-m-d') }}"/>
              <div class="help-block with-errors with-errors--table"></div>
            </td>
            <td class="table__details">
              <div class="form__content">
                <select id="rest_pattern_1" class="form__input form__input--select form__input--full" name="screening_1_method_used">
                    @foreach(resistance_pattern() as $pattern)
                        <option value="{{ $pattern }}" {{ $screenings[0]->method_used === $pattern ? 'selected' : ''}}>{{ $pattern }}</option>
                    @endforeach
                </select>
                <div class="triangle triangle--down"></div>
              </div>
            </td>
            <td class="table__details">
              <div class="form__content">
                <select id="method_used_1" class="form__input form__input--select form__input--full" name="screening_1_resistance_pattern">
                    @foreach(method_used() as $method)
                        <option value="{{ $method }}" {{ $screenings[0]->resistance_pattern === $method ? 'selected': '' }}>{{ $method }}</option>
                    @endforeach
                </select>
                <div class="triangle triangle--down"></div>
              </div>
            </td>
          </tr>
          <input type="hidden" id="hasScreening2" value="{{ $screenings->count() > 1 ? true : false }}">
          <tr class="table__row screening-2 form-step-2">
            <td class="table__details">Screening 2</td>
            <td class="table__details form-group">
            <div class="help-block with-errors"></div>
            <input class="form__input form__input--full" id="screening_2_date" type="date" name="" value="{{ isset($screenings[1]) ? $screenings[1]->date_collected->format('Y-m-d') : '' }}"/></td>
            <td class="table__details">
            <div class="form__content">
                <select id="rest_pattern_2" class="form__input form__input--select form__input--full" name="">
                    @foreach(resistance_pattern() as $pattern)
                        <option value="{{ $pattern }}" {{ isset($screenings[1]) ? ($screenings[1]->method_used === $pattern ? 'selected' : '') : ''}}>{{ $pattern }}</option>
                    @endforeach
                </select>
                <div class="triangle triangle--down"></div>
            </div>
            </td>
            <td class="table__details">
            <div class="form__content">
                <select id="method_used_2"class="form__input form__input--select form__input--full" name="">
                    @foreach(method_used() as $method)
                        <option value="{{ $method }}" {{ isset($screenings[1]) ? ($screenings[1]->resistance_pattern === $method ? 'selected': '') : '' }}>{{ $method }}</option>
                    @endforeach
                </select>
                <div class="triangle triangle--down"></div>
            </div>
            </td>
        </tr>
        </tbody>
      </table>
        @if($screenings->count() > 1)
        <button class="button button--transparent button--add" id="remove-screening" type="button">Remove</button>
        @else
            <button class="button button--transparent button--add" id="add-screening" type="button">Add more</button>
        @endif
    </div>
    <div class="form__container">
      <table class="table table--unset js-table-unset">
        <thead>
          <tr>
            <th class="table__head"></th>
            <th class="table__head">Date collected</th>
            <th class="table__head">Resistance pattern</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table__row form-step-2">
            <td class="table__details">LPA</td>
            <td class="table__details form-group">
              <input class="form__input form__input--full" type="date" name="lpa_date_collected" required value="{{ $lpa->date_collected->format('Y-m-d') }}"/>
              <div class="help-block with-errors with-errors--table"></div>
            </td>
            <td class="table__details">
              <div class="form__content">
                <select class="form__input form__input--select form__input--full" name="lpa_resistance_pattern">
                  @foreach(LPA() as $lpaOption)
                    <option value="{{ $lpaOption }}" {{ $lpa->resistance_pattern == $lpaOption ? 'selected' : '' }}>{{ $lpaOption }}</option>
                  @endforeach
                </select>
                <div class="triangle triangle--down"></div>
              </div>
            </td>
          </tr>
          <tr class="table__row form-step-2">
            <td class="table__details">DST</td>
            <td class="table__details form-group">
              <input class="form__input form__input--full" type="date" name="dst_date_collected" required value="{{ $dst->date_collected->format('Y-m-d') }}"/>
              <div class="help-block with-errors with-errors--table"></div>
            </td>
            <td class="table__details">
              <div class="form__content">
                <select id="rest_pattern_4" class="form__input form__input--select form__input--full" name="dst_resistance_pattern">
                  @foreach(DST() as $dstOption)
                    <option value="{{ $dstOption}}" {{ $dst->resistance_pattern == $dstOption ? 'selected' : '' }}>{{ $dstOption }}</option>
                  @endforeach
                </select>
                <div class="triangle triangle--down"></div>
              </div>
            </td>
          </tr>
          <input type="hidden" id="othersDST" value="{{ $dst->resistance_pattern == 'Other (specify)' ? true : false }}">
          <tr id="others" class="form-step-2">
            <td></td>
            <td class="form-group">
                <span>Others (Please Specify)</span>
                <br/>
                <input type="text" class="form__input" name="dst_resistance_pattern_others" value="{{ $dst->resistance_pattern == 'Other (specify)' ? $dst->resistance_pattern_others  : '' }}">
                <div class="help-block with-errors with-errors--table"></div>
              </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="form__container form-step-2">
      <table class="table table--unset js-table-unset js-table-rows" id="m-screening">
          <thead>
          <tr>
              <th class="table__head">Month</th>
              <th class="table__head">Date collected</th>
              <th class="table__head">Smear microscopy</th>
              <th class="table__head">TB-LAMP</th>
              <th class="table__head">Culture</th>
          </tr>
          </thead>
          <tbody id="screenings">
          @foreach($monthlyScreenings as $key =>  $monthlyScreening)
          <tr class="table__row form-step-2">
              <td class="table__details">
                  <span class="base-letter">{{ $loop->first ? 'B' : $key }}</span>
                  <span class="counter"></span></td>
              <td class="table__details form-group">
              <div class="help-block with-errors with-errors--table"></div>
                  <input class="form__input form__input--full" required type="date" name="date_collected[]" value="{{ $monthlyScreening->date_collected->format('Y-m-d') }}" />
              </td>
              <td class="table__details">
              <div class="form__content">
                  <select class="form__input form__input--select form__input--full" name="smear_microscopy[]">
                    @foreach(treatmentSmear() as $sm)
                        <option value="{{ $sm }}"{{ $monthlyScreening->smear_microscopy === $sm ? 'selected' : '' }}>{{ $sm }}</option>
                    @endforeach
                  </select>
                  <div class="triangle triangle--down"></div>
              </div>
              </td>
              <td class="table__details">
                <div class="form__content">
                    <select class="form__input form__input--select form__input--full" name="tb_lamp[]">
                        @foreach(tb_lamp() as $tl)
                            <option value="{{ $tl }}"{{$monthlyScreening->tb_lamp === $tl ? 'selected' : ''}}>{{ $tl }}</option>
                        @endforeach
                    </select>
                    <div class="triangle triangle--down"></div>
                </div>
              </td>
              <td class="table__details">
                <div class="form__content">
                    <select class="form__input form__input--select form__input--full" name="culture[]">
                        @foreach(treatmentCulture() as $culture)
                            <option value="{{ $culture }}"{{$monthlyScreening->culture === $culture ? 'selected' : ''}}>{{ $culture }}</option>
                        @endforeach
                    </select>
                    <div class="triangle triangle--down"></div>
                </div>
              </td>
              {{-- <td class="screenings-remove">
                <button class="button button--transparent remove-monthly-screening" type="button">Remove</button>
              </td> --}}
              
              
          </tr>
          @endforeach
          </tbody>
      </table>
      <button class="button button--transparent button--add" id="case-management-add-button" type="button">Add more</button>
      </div>
    <div class="form__button form__button--space form__button--pagination step-2">
      <button class="button button--back" type="button">Back</button>
      <button class="button button--next" type="button">Next</button>
    </div>
</div>