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

    API.addQuestionsSet('ce_first_step_pregnant', {
        inherit: 'singleChoice',
        name:    'ce_first_step_pregnant',
        stem:    '<p class="excellent">That answer was incorrect. Please try again. (Attempt 2 out of 3)<p> \
                  What is the best first step to providing patient centered genetic counseling to a pregnant patient who comes to you for prenatal genetic testing?',
        answers: [
            {text: 'Ensuring patient understands that screening blood tests are not 100% accurate',   value: 1},
            {text: 'Exploring the patient’s needs, values and desires for information',               value: 2},
            {text: 'Asking the patient whether she would terminate a pregnancy if affected with a genetic condition', value: 3},
            {text: 'Discussing the timing of when screening and diagnostic testing can be performed', value: 4},
        ],
    });

    API.addSequence([
        {
            inherit: 'basicPage',
            questions: [
                {inherit: 'ce_first_step_pregnant'}
            ]
        },
    ]);

    return API.script;
});
