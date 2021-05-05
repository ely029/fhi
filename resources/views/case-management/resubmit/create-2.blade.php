<div class="form__tab step-2">
    <h2 class="section__heading">Bacteriological results and status</h2>
    <div class="form__container form-step-2">
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
                  $screenone = $tbMacForm->screenOne;
                  $screenTwo = $tbMacForm->screenTwo;
                  $lpa = $tbMacForm->lpa;
                  $dst = $tbMacForm->dst;
                  $monthlyScreening = $tbMacForm->monthlyScreening;
        @endphp
        <tr class="table__row">
            {{-- @foreach($screenone as $one) --}}
            <td class="table__details">{{ empty($screenone->label) ? '' : $screenone->label }}</td>
            <td class="table__details">
            <input class="form__input form__input--full" type="date" value="{{ $screenone ? $screenone->date_collected->format('Y-m-d') : ''}}" name="date_collected_screening_1" /></td>
            <td class="table__details">
            <div class="form__content">
                <select id="rest_pattern_1" class="form__input form__input--select form__input--full" name="ressitance_pattern_screening_1">
                @foreach(resistance_pattern() as $pattern)
                <option value="{{ $pattern }}" {{$screenone ? ($screenone->resistance_pattern === $pattern ? 'selected' : '') : ''}}>{{ $pattern }}</option>
                @endforeach
                </select>
                <div class="triangle triangle--down"></div>
            </div>
            </td>
            <td class="table__details">
            <div class="form__content form-group">
                <select id="method_used_1" class="form__input form__input--select form__input--full" name="method_used_screening_1">
                @foreach(method_used() as $method)
                <option value="{{ $method }}" {{ $screenone ? ($screenone->method_used === $method ? 'selected': '') : ''}}>{{ $method }}</option>
                @endforeach
                </select>
                <div class="triangle triangle--down"></div>
            </div>
            </td>
            {{-- @endforeach --}}
            
        </tr>
        <input type="hidden" id="hasScreening2" value="{{ $screenTwo ? true : false }}">
        <tr class="table__row screening-2 form-step-2">
        {{-- @foreach($screenTwo as $one) --}}
        
            <td class="table__details">Screening 2</td>
            <td class="table__details form-group">
            <div class="help-block with-errors"></div>
            <input class="form__input form__input--full" type="date" value="{{ $screenTwo ? $screenTwo->date_collected->format('Y-m-d') : ''}}" name="date_collected_screening_2" /></td>
            <td class="table__details">
            <div class="form__content">
                <select id="rest_pattern_2" class="form__input form__input--select form__input--full" name="ressitance_pattern_screening_2">
                @foreach(resistance_pattern() as $pattern)
                <option value="{{ $pattern }}" {{ $screenTwo ? ($screenTwo->resistance_pattern === $pattern ? 'selected' : '') : ''}}>{{ $pattern }}</option>
                @endforeach
                </select>
                <div class="triangle triangle--down"></div>
            </div>
            </td>
            <td class="table__details">
            <div class="form__content form-group">
                <select id="method_used_2" class="form__input form__input--select form__input--full" name="method_used_screening_2">
                @foreach(method_used() as $method)
                <option value="{{ $method }}" {{ $screenTwo ? ($screenTwo->method_used === $method ? 'selected': '') : ''}}>{{ $method }}</option>
                @endforeach
                </select>
                <div class="triangle triangle--down"></div>
            </div>
            </td>
            {{-- @endforeach --}}
        </tr>
        </tbody>
    </table>
    @if($screenTwo)
        <button class="button button--transparent button--add" id="remove-screening" type="button">Remove</button>
    @else
        <button class="button button--transparent button--add" id="add-screening" type="button">Add more</button>
    @endif
    </div>
    <div class="form__container form-step-2">
    <table class="table table--unset js-table-unset">
        <thead>
        <tr>
            <th class="table__head"></th>
            <th class="table__head">Date collected</th>
            <th class="table__head">Resistance pattern</th>
        </tr>
        </thead>
        <tbody>
            {{-- @foreach($lpa as $lpa) --}}
            <tr class="table__row">
            <td class="table__details">LPA</td>
            <td class="table__details"><input class="form__input form__input--full" value="{{ $lpa ? $lpa->date_collected->format('Y-m-d') : ''}}" type="date" name="date_collected_lpa" /></td>
            <td class="table__details">
            <div class="form__content">
            <select id="rest_pattern_3" class="form__input form__input--select form__input--full" name="resistance_pattern_lpa">
                @foreach(LPA() as $pattern)
                <option value="{{ $pattern }}" {{ $lpa ? ($lpa->resistance_pattern === $pattern ? 'selected': '') : ''}}>{{ $pattern }}</option>
                @endforeach
                </select>
                <div class="triangle triangle--down"></div>
            </div>
            </td>
        </tr>
            {{-- @endforeach --}}
            {{-- @foreach($dst as $dst) --}}
            <tr class="table__row">
            <td class="table__details">DST</td>
            <td class="table__details"><input class="form__input form__input--full" value="{{ $dst ? $dst->date_collected->format('Y-m-d') : '' }}" type="date" name="date_collected_dst" /></td>
            <td class="table__details">
            <div class="form__content">
            <select id="rest_pattern_4" class="form__input form__input--select form__input--full" name="resistance_pattern_dst">
                @foreach(DST() as $pattern)
                <option value="{{ $pattern }}" {{ $dst ? ($dst->resistance_pattern === $pattern ? 'selected': '') : ''}}>{{ $pattern }}</option>
                @endforeach
                </select>
                <div class="triangle triangle--down"></div>
            </div>
            </td>
        </tr>
        <tr id="others">
            <td></td>
            <td>
                <span>Others (Please Specify)</span>
                <br/>
                <input type="text" name="others_bacteriological_results"></td>
        </tr>
            {{-- @endforeach --}}
        </tbody>
    </table>
    </div>
    <div id="count">
    @foreach($monthlyScreening as $ms)
        <input type="hidden" value="{{ $ms->count }}" id="{{ $ms->count }}" name="count[]"/>
    @endforeach
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
        @foreach($monthlyScreening as $ms)
        <tr class="table__row">
        <td class="table__details"><Sspan class="counter">{{ $ms->count }}</Sspan></td>
            <td class="table__details"><input class="form__input form__input--full" value="{{ $ms->date_collected->format('Y-m-d') }}" type="date" name="date_collected[]" /></td>
            <td class="table__details">
            <div class="form__content">
                <select class="form__input form__input--select form__input--full" name="smear_microscopy[]">
                @foreach(smear_microscopy() as $sm)
                <option value="{{ $sm }}"{{ $ms->smear_microscopy === $sm ? 'selected' : '' }}>{{ $sm }}</option>
                @endforeach
                </select>
                <div class="triangle triangle--down"></div>
            </div>
            </td>
            <td class="table__details">
            <div class="form__content">
                <select class="form__input form__input--select form__input--full" name="tb_lamp[]">
                @foreach(tb_lamp() as $tl)
                <option value="{{ $tl }}"{{$ms->tb_lamp === $tl ? 'selected' : ''}}>{{ $tl }}</option>
                @endforeach
                </select>
                <div class="triangle triangle--down"></div>
            </div>
            </td>
            <td class="table__details">
            <div class="form__content">
                <select class="form__input form__input--select form__input--full" name="culture[]">
                @foreach(culture() as $c)
                <option value="{{ $c }}" {{ $ms->culture === $c ? 'selected' : ''}}>{{ $c }}</option>
                @endforeach
                </select>
                <div class="triangle triangle--down"></div>
            </div>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <button class="button button--transparent button--add" id="case-management-add-button" type="button">Add more</button>
    </div>
    <div class="form__button form__button--space form__button--pagination"><button class="button button--back" type="button">Back</button><button class="button button--next" type="button">Next</button></div>
</div>