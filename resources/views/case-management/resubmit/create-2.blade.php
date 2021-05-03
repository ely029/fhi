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
        @php
                  $screenone = $tbMacForm->screenOne;
                  $screenTwo = $tbMacForm->screenTwo;
                  $lpa = $tbMacForm->lpa;
                  $dst = $tbMacForm->dst;
                  $monthlyScreening = $tbMacForm->monthlyScreening;
        @endphp
        <tr class="table__row">
            @foreach($screenone as $one)
            <td class="table__details">{{ $one->label }}</td>
            <td class="table__details">
            <input class="form__input form__input--full" type="date" value="{{ $one->date_collected->format('Y-m-d')}}" name="date_collected_screening_1" /></td>
            <td class="table__details">
            <div class="form__content">
                <select id="rest_pattern_1" class="form__input form__input--select form__input--full" name="ressitance_pattern_screening_1">
                @foreach(resistance_pattern() as $pattern)
                <option value="{{ $pattern }}" {{$one->label === $pattern ? 'selected' : ''}}>{{ $pattern }}</option>
                @endforeach
                </select>
                <div class="triangle triangle--down"></div>
            </div>
            </td>
            <td class="table__details">
            <div class="form__content form-group">
                <select id="method_used_1" class="form__input form__input--select form__input--full" name="method_used_screening_1">
                @foreach(method_used() as $method)
                <option value="{{ $method }}" {{ $one->method_used === $method ? 'selected': ''}}>{{ $method }}</option>
                @endforeach
                </select>
                <div class="triangle triangle--down"></div>
            </div>
            </td>
            @endforeach
            
        </tr>
        <tr class="table__row">
        @foreach($screenTwo as $one)
            <td class="table__details">{{ $one->label }}</td>
            <td class="table__details">
            <input class="form__input form__input--full" type="date" value="{{ $one->date_collected->format('Y-m-d')}}" name="date_collected_screening_2" /></td>
            <td class="table__details">
            <div class="form__content">
                <select id="rest_pattern_1" class="form__input form__input--select form__input--full" name="ressitance_pattern_screening_2">
                @foreach(resistance_pattern() as $pattern)
                <option value="{{ $pattern }}" {{$one->label === $pattern ? 'selected' : ''}}>{{ $pattern }}</option>
                @endforeach
                </select>
                <div class="triangle triangle--down"></div>
            </div>
            </td>
            <td class="table__details">
            <div class="form__content form-group">
                <select id="method_used_1" class="form__input form__input--select form__input--full" name="method_used_screening_2">
                @foreach(method_used() as $method)
                <option value="{{ $method }}" {{ $one->method_used === $method ? 'selected': ''}}>{{ $method }}</option>
                @endforeach
                </select>
                <div class="triangle triangle--down"></div>
            </div>
            </td>
            @endforeach
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
            @foreach($lpa as $lpa)
            <tr class="table__row">
            <td class="table__details">{{ $lpa->label }}</td>
            <td class="table__details"><input class="form__input form__input--full" value="{{ $lpa->date_collected->format('Y-m-d')}}" type="date" name="date_collected_lpa" /></td>
            <td class="table__details">
            <div class="form__content">
            <select id="rest_pattern_3" class="form__input form__input--select form__input--full" name="resistance_pattern_lpa">
                @foreach(resistance_pattern() as $pattern)
                <option value="{{ $pattern }}" {{ $one->resistance_pattern === $pattern ? 'selected': ''}}>{{ $pattern }}</option>
                @endforeach
                </select>
                <div class="triangle triangle--down"></div>
            </div>
            </td>
        </tr>
            @endforeach
            @foreach($dst as $dst)
            <tr class="table__row">
            <td class="table__details">{{ empty($dst->label) ? '' : $dst->label }}</td>
            <td class="table__details"><input class="form__input form__input--full" value="{{ empty($dst->date_collected) ? '' : $dst->date_collected->format('Y-m-d')}}" type="date" name="date_collected_dst" /></td>
            <td class="table__details">
            <div class="form__content">
            <select id="rest_pattern_3" class="form__input form__input--select form__input--full" name="resistance_pattern_dst">
                @foreach(resistance_pattern() as $pattern)
                <option value="{{ $pattern }}" {{ $one->resistance_pattern === $pattern ? 'selected': ''}}>{{ $pattern }}</option>
                @endforeach
                </select>
                <div class="triangle triangle--down"></div>
            </div>
            </td>
        </tr>
            @endforeach
        </tbody>
    </table>
    </div>
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
        <tbody>
        @foreach($monthlyScreening as $ms)
        <tr class="table__row">
        <td class="table__details">{{ $ms->label }}</td>
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
    <button class="button button--transparent button--add js-add-row" type="button">Add more</button>
    </div>
    <div class="form__button form__button--space form__button--pagination"><button class="button button--back" type="button">Back</button><button class="button button--next" type="button">Next</button></div>
</div>