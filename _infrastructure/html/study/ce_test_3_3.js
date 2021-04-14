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

    API.addQuestionsSet('ce_exploring_desires', {
        inherit: 'singleChoice',
        name:    'ce_exploring_desires',
        stem:    '<p class="excellent">That answer was incorrect. Please try again. (Final attempt)<p> \
                  Why is exploring patients’ desires, needs and values important in genetic counseling?',
        answers: [
            {text: 'Depending on clinical circumstances, genetic testing may be optional.', value: 1},
            {text: 'The benefits and risks of genetic testing may depend upon unique aspects of an individual.', value: 2},
            {text: 'Risks and benefits are weighed differently by individuals.',            value: 3},
            {text: 'All of the above',                                                      value: 4},
        ],
    });


    API.addSequence([
        {
            inherit: 'basicPage',
            questions: [
                {inherit: 'ce_exploring_desires'}
            ]
        },
    ]);

    return API.script;
});
