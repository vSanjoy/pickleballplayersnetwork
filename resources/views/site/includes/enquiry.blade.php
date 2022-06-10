{{ Form::open(['name' => 'contactForm', 'id' => 'contactForm', 'files' => true, 'novalidate' => true]) }}
    {{-- <div class="formHeading"><span>Wherever you go, We're here to help.</span></div> --}}
    <div class="row">
        <div class="col-xs-6 formLeftWrap">
            <div class="formLeftTop">
                {{-- <div class="formTop">This area is for Correspondance</div> --}}
                <div class="subheading">
                    <svg viewBox="0 0 500 100">
                        <path id="curve" d="M 50 100 q 200 -80 400 0 Z" />
                        <text>
                            <textPath xlink:href="#curve" alignment-baseline="top">&nbsp;Send us a note&nbsp;</textPath>
                        </text>
                    </svg>
                    <span class="resView">Send us a note</span>
                </div>
                <div class="subtag">Someone from our customer experience team will get back to you within 48 hours.</div>
                <div class="formTo">Conrad,</div>
            </div>
            <label class="labelWrap hideLabel hidePlaceholder mb0">
                <span>Note</span>
                {{ Form::textarea('note', null, [
                                                'id' => 'note',
                                                'placeholder' => 'Note',
                                                'class' => '',
                                                'required' => true,
                                            ]) }}
            </label>
        </div>
        <div class="col-xs-6 formRightWrap">
            <div class="formRight">
                <label class="labelWrap">
                    <span>@lang('custom.label_to')</span>
                    <input type="text" placeholder="To:" name="" value="{{ $siteSettings['to_email'] }}" readonly>
                </label>
                <label class="labelWrap showPlaceholder">
                    <span>@lang('custom.label_from')</span>
                    {{ Form::text('name', null, [
                                                'id' => 'name',
                                                'placeholder' => '(First & Last name)',
                                                'class' => '',
                                                'required' => true,
                                            ]) }}
                </label>
                <label class="labelWrap hidePlaceholder">
                    <span>@lang('custom.label_email')</span>
                    {{ Form::email('email', null, [
                                                    'id' => 'email',
                                                    'placeholder' => 'Email',
                                                    'class' => '',
                                                    'required' => true,
                                                ]) }}
                </label>
                <label class="labelWrap">
                    <span>@lang('custom.label_subject')</span>
                    {{ Form::text('subject', null, [
                                                    'id' => 'subject',
                                                    'placeholder' => 'Subject',
                                                    'class' => '',
                                                    'required' => true,
                                                ]) }}
                </label>
            </div>
        </div>
    </div>
    <div class="formBtn">
        <button type="submit" class="btn btn_custom">@lang('custom.label_send')</button>
    </div>
{{ Form::close() }}