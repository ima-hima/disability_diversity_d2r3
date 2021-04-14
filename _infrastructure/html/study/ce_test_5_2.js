define(['questAPI', 'underscore'], function(Quest, _){

    var API     = new Quest();
    var isTouch = API.getGlobal().isTouch;

    /**
     * Settings
     */
    API.addSettings('logger', { pulse: 3 });

    /**
     * Page
     */
    API.addPagesSet('basicPage', {
        noSubmit:    false, //Change to true if you don't want to show the submit button.
        decline:     false,
        autoFocus:   true,
        header:      'Continuing Education Quiz',
        numbered:    false,
        prev:        true
    });

    /**
     * Question prototypes
     */
    API.addQuestionsSet('basicQ', {
        decline:   false,
        required : true,
        errorMsg: {
            required: isTouch
                ? 'Please select an answer'
                : 'Please select an answer'
        },
        autoSubmit:    true,
        numericValues: true
    });

    API.addQuestionsSet('singleChoice', {
        inherit:  'basicQ',
        numericValues: true,
        type:     'selectOne',
        help:     '<%= pagesMeta.number < 10 %>',
        helpText: 'Tip: For quick response, double click on an answer to select it and go to the next page.'
    });

    API.addQuestionsSet('text', {
        inherit: 'basicQ',
        type:    'text',
        noSubmit: false
    });

    API.addQuestionsSet('singleChoicedrop', {
        inherit:    'basicQ',
        autoSubmit: false,
        type:       'dropdown'
    });

    API.addQuestionsSet('multiChoice', {
        inherit: 'basicQ',
        type:    'selectMulti'
    });

    API.addQuestionsSet('boolean', {
        inherit:  'basicQ',
        type:     'selectOne',
        buttons:  true,
        answers : [
            {text: 'Yes', value:1},
            {text: 'No', value:0}
        ]
    });

    /**
     * Actual questions
     */

    API.addQuestionsSet('ce_implicit_bias', {
        inherit: 'singleChoice',
        name:    'ce_implicit_bias',
        stem:    '<p class="excellent">That answer was incorrect. Please try again. (Attempt 2 out of 3)<p> \
                  Which of the following is true regarding the role implicit bias can play in healthcare?',
        answers: [
            {text: 'It is insurmountable and is always acted upon by the provider.', value: 1},
            {text: 'It can impact provider-patient relationships.',                  value: 2},
            {text: 'It is not relevant to clinical practice.',                       value: 3},
            {text: 'It does not impact patient health outcomes.',                    value: 4},
        ],
    });

    API.addSequence([
        {
            inherit: 'basicPage',
            questions: [
                {inherit: 'ce_implicit_bias'}
            ]
        },
    ]);

    return API.script;
});
