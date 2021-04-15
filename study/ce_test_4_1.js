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

    API.addQuestionsSet('ce_pregnant_patient', {
        inherit: 'singleChoice',
        name:    'ce_pregnant_patient',
        stem:    'A 12-week pregnant patient desires genetic testing because she is 39 years old and is concerned about the increased risk for chromosome abnormalities. Using patient-centered techniques reviewed in this module, what are the best initial topics to discuss with the patient?',
        answers: [
            {text: 'I would recommend invasive testing (CVS or amniocentesis) because it will provide the most accurate information.', value: 1},
            {text: 'I would recommend a screening test, such as non-invasive prenatal screening, because it will not pose a risk to her pregnancy.', value: 2},
            {text: 'I would not recommend any testing to the patient unless she would terminate an affected pregnancy.', value: 3},
            {text: 'I would first explore the patient’s goals for testing in order to help her determine which test, if any, would be helpful to her.', value: 4},
        ],
    });

    API.addSequence([
        {
            inherit: 'basicPage',
            questions: [
                {inherit: 'ce_pregnant_patient'}
            ]
        },
    ]);

    return API.script;
});
