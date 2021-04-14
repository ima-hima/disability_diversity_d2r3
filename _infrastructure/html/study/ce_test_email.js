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

    API.addQuestionsSet('email', {
        inherit:  'text',
        name:     'email',
        stem:     'Please enter your email address so that we can contact you about receiving credit for this course.',
        required: true,
        pattern:  /[A-Z0-9\._%+-]+@[A-Z0-9\.-]{2,}\.[A-Z]{2,}/igm,
        errorMsg: {
            required: "You must enter a valid email address.",
            pattern:  "This is not a valid email address.",
        },
    });

    API.addSequence([
        {
            inherit: 'basicPage',
            questions: [{inherit: 'email'}]
        },
    ]);

    return API.script;
});
