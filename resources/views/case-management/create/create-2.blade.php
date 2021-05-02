<div class="form__tab step-2">
    <h2 class="section__heading">Bacteriological results and status</h2>
    <div class="form__container form-step-2">
    <table class="table table--unset js-table-unset">
        <thead>
        <tr>
            <th class="table__head"></th>
            <th class="table__head">Date collected</th>
            <th class="table__head">Resistance pattern</th>
            <th class="table__head">Method used</th>
        </tr>
        </thead>
        <tbody>
        <tr class="table__row">
            <td class="table__details">Screening 1</td>
            <td class="table__details">
            <input class="form__input form__input--full" type="date" name="date_collected_screening_1" /></td>
            <td class="table__details">
            <div class="form__content">
                <select id="rest_pattern_1" class="form__input form__input--select form__input--full" name="ressitance_pattern_screening_1">
                <option value="For Xpert MTB/RIF">Xpert MTB/RIF</option>
                <option value="For Xpert MTB/RIF ULTRA">Xpert MTB/RIF ULTRA</option>
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
        <tr class="table__row">
            <td class="table__details">Screening 2</td>
            <td class="table__details form-group">
            <div class="help-block with-errors"></div>
            <input class="form__input form__input--full" type="date" name="date_collected_screening_2"/></td>
            <td class="table__details">
            <div class="form__content">
                <select id="rest_pattern_2" class="form__input form__input--select form__input--full" name="ressitance_pattern_screening_2">
                <option value="For Xpert MTB/RIF">Xpert MTB/RIF</option>
                <option value="For Xpert MTB/RIF ULTRA">Xpert MTB/RIF ULTRA</option>
                <option value="Truenat">Truenat</option>
                </select>
                <div class="triangle triangle--down"></div>
            </div>
            </td>
            <td class="table__details">
            <div class="form__content">
                <select id="method_used_2"class="form__input form__input--select form__input--full" name="method_used_screening_2">
                <option value='MTB Detected, Rifampicin Resistance Detected'>MTB Detected, Rifampicin Resistance Detected</option><option value='MTB Detected, Rifampicin Resistance Not Detected'>MTB Detected, Rifampicin Resistance Not Detected</option><option value='MTB Detected, Rifampicin Resistance Indeterminate'>MTB Detected, Rifampicin Resistance Indeterminate</option><option value='MTB Not Detected'>MTB Not Detected</option><option value='Invalid/No Result/Error'>Invalid/No Result/Error</option>
                </select>
                <div class="triangle triangle--down"></div>
            </div>
            </td>
        </tr>
        </tbody>
    </table>
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
        <tr class="table__row">
            <td class="table__details">LPA</td>
            <td class="table__details"><input class="form__input form__input--full" type="date" name="date_collected_lpa" /></td>
            <td class="table__details">
            <div class="form__content">
            <select id="rest_pattern_3" class="form__input form__input--select form__input--full" name="resistance_pattern_lpa">
                <option value="For Xpert MTB/RIF">Xpert MTB/RIF</option>
                <option value="For Xpert MTB/RIF ULTRA">Xpert MTB/RIF ULTRA</option>
                <option value="Truenat">Truenat</option>
                </select>
                <div class="triangle triangle--down"></div>
            </div>
            </td>
        </tr>
        <tr class="table__row">
            <td class="table__details">DST</td>
            <td class="table__details"><input class="form__input form__input--full" type="date" name="date_collected_dst" /></td>
            <td class="table__details">
            <div class="form__content">
            <select id="rest_pattern_4" class="form__input form__input--select form__input--full" name="resistance_pattern_dst">
                <option value="For Xpert MTB/RIF">Xpert MTB/RIF</option>
                <option value="For Xpert MTB/RIF ULTRA">Xpert MTB/RIF ULTRA</option>
                <option value="Truenat">Truenat</option>
                </select>
                <div class="triangle triangle--down"></div>
            </div>
            </td>
        </tr>
        </tbody>
    </table>
    </div>
    <div id="count">
        <input type="hidden" value="B" name="count[]"/>
    </div>
    <input type="text" value="0" id="count_row"/>
    <div class="form__container form-step-2">
    <table class="table table--unset js-table-unset js-table-rows">
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
        <tr class="table__row">
            <td class="table__details">B</td>
            <td class="table__details"><input class="form__input form__input--full" type="date" name="date_collected[]" /></td>
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
    <button class="button button--transparent button--add js-add-row" id="case-management-add-button" type="button">Add more</button>
    </div>
    <div class="form__button form__button--space form__button--pagination"><button class="button button--back" type="button">Back</button><button class="button button--next" type="button">Next</button></div>
</div>