<div class="form__tab step-2">
    <h2 class="section__heading">Bacteriological results and status</h2>
    <div class="form__container form-step-2">
    <table class="table table--unset js-table-unset" id="screening-table-1">
        <thead>
        <tr>
            <th class="table__head no-sort"></th>
            <th class="table__head">Date collected</th>
            <th class="table__head">Method used</th>
            <th class="table__head">Resistance pattern</th>
        </tr>
        </thead>
        <tbody>
        <tr class="table__row form-step-2">
            <td class="table__details">Screening <span class="screening-counter">1</span></td>
            <td class="table__details form-group">
                <input class="form__input form__input--full" type="date" name="date_collected_screening_1" required />
                <div class="help-block with-errors with-errors--table"></div>
            </td>
            <td class="table__details">
            <div class="form__content">
                <select id="rest_pattern_1" class="form__input form__input--select form__input--full" name="ressitance_pattern_screening_1">
                <option value="Xpert MTB/RIF">Xpert MTB/RIF</option>
                <option value="Xpert MTB/RIF ULTRA">Xpert MTB/RIF ULTRA</option>
                <option value="Truenat">Truenat</option>
                </select>
                <div class="triangle triangle--down"></div>
            </div>
            </td>
            <td class="table__details">
            <div class="form__content form-group">
                <select id="method_used_1" class="form__input form__input--select form__input--full" name="method_used_screening_1">
                <option value='MTB Detected, Rifampicin Resistance Detected'>MTB Detected, Rifampicin Resistance Detected</option><option value='MTB Detected, Rifampicin Resistance Not Detected'>MTB Detected, Rifampicin Resistance Not Detected</option><option value='MTB Detected, Rifampicin Resistance Indeterminate'>MTB Detected, Rifampicin Resistance Indeterminate</option><option value='MTB Not Detected'>MTB Not Detected</option><option value='Invalid/No Result/Error'>Invalid/No Result/Error</option>
                </select>
                <div class="triangle triangle--down"></div>
            </div>
            </td>
        </tr>
        <tr class="table__row screening-2 form-step-2">
            <td class="table__details">Screening 2</td>
            <td class="table__details form-group">
            <div class="help-block with-errors"></div>
            <input class="form__input form__input--full" type="date" name=""/></td>
            <td class="table__details">
            <div class="form__content">
                <select id="rest_pattern_2" class="form__input form__input--select form__input--full" name="">
                <option value="Xpert MTB/RIF">Xpert MTB/RIF</option>
                <option value="Xpert MTB/RIF ULTRA">Xpert MTB/RIF ULTRA</option>
                <option value="Truenat">Truenat</option>
                </select>
                <div class="triangle triangle--down"></div>
            </div>
            </td>
            <td class="table__details">
            <div class="form__content">
                <select id="method_used_2"class="form__input form__input--select form__input--full" name="">
                <option value='MTB Detected, Rifampicin Resistance Detected'>MTB Detected, Rifampicin Resistance Detected</option><option value='MTB Detected, Rifampicin Resistance Not Detected'>MTB Detected, Rifampicin Resistance Not Detected</option><option value='MTB Detected, Rifampicin Resistance Indeterminate'>MTB Detected, Rifampicin Resistance Indeterminate</option><option value='MTB Not Detected'>MTB Not Detected</option><option value='Invalid/No Result/Error'>Invalid/No Result/Error</option>
                </select>
                <div class="triangle triangle--down"></div>
            </div>
            </td>
        </tr>
        </tbody>
    </table>
    <button class="button button--transparent button--add" id="add-screening" type="button">Add more</button>
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
        <tr class="table__row form-step-2">
            <td class="table__details">LPA</td>
            <td class="table__details form-group">
                
                <input class="form__input form__input--full" required type="date" name="date_collected_lpa" />
                <div class="help-block with-errors with-errors--table"></div>
            </td>
            <td class="table__details">
            <div class="form__content">
            <select id="rest_pattern_3" class="form__input form__input--select form__input--full" name="resistance_pattern_lpa">
            @foreach(LPA() as $lpa)
                <option value="{{ $lpa }}">{{ $lpa }}</option>
                @endforeach
                </select>
                <div class="triangle triangle--down"></div>
            </div>
            </td>
        </tr>
        <tr class="table__row form-step-2">
            <td class="table__details">DST</td>
            <td class="table__details form-group">
                <input class="form__input form__input--full" required type="date" name="date_collected_dst" />
                <div class="help-block with-errors with-errors--table"></div>
            </td>
            <td class="table__details">
            <div class="form__content">
            <select id="rest_pattern_4" class="form__input form__input--select form__input--full" name="resistance_pattern_dst">
                @foreach(DST() as $dst)
                <option value="{{ $dst}}">{{ $dst }}</option>
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
        </tbody>
    </table>
    </div>
    <div id="count">
        <input type="hidden" value="B" name="count[]"/>
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
        <tr class="table__row form-step-2">
            <td class="table__details"><span class="base-letter">B</span><span class="counter"></span></td>
            <td class="table__details form-group">
            <div class="help-block with-errors with-errors--table"></div>
                <input class="form__input form__input--full" required type="date" name="date_collected[]" />
            </td>
            <td class="table__details">
            <div class="form__content">
                <select class="form__input form__input--select form__input--full" name="smear_microscopy[]">
                <option value="0">0</option>
                <option value="+n">+n</option>
                <option value="1+">1+</option>
                <option value="2+">2+</option>
                <option value="3+">3+</option>
                </select>
                <div class="triangle triangle--down"></div>
            </div>
            </td>
            <td class="table__details">
            <div class="form__content">
                <select class="form__input form__input--select form__input--full" name="tb_lamp[]">
                <option value="Positive">Positive</option>
                <option value="Negative">Negative</option>
                <option value="Indeterminate">Indeterminate</option>
                </select>
                <div class="triangle triangle--down"></div>
            </div>
            </td>
            <td class="table__details">
            <div class="form__content">
                <select class="form__input form__input--select form__input--full" name="culture[]">
                <option value="Positive">Positive</option>
                <option value="Negative">Negative</option>
                <option value="Non-tuberculous Mycobacteria (NTM)">Non-tuberculous Mycobacteria (NTM)</option>
                <option value="Contaminated">Contaminated</option>
                </select>
                <div class="triangle triangle--down"></div>
            </div>
            </td>
        </tr>
        </tbody>
    </table>
    <button class="button button--transparent button--add" id="case-management-add-button" type="button">Add more</button>
    </div>
    <div class="form__button form__button--space form__button--pagination"><button class="button button--back" type="button">Back</button><button class="button button--next" type="button">Next</button></div>
</div>