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

    API.addQuestionsSet('autonomous_patient_decisions', {
        inherit: 'singleChoice',
        name:    'autonomous_patient_decisions',
        stem:    'Autonomous patient decision making can be promoted by all of the following, EXCEPT:',
        answers: [
            {text: 'Exploring feelings behind decision making',                       value: 1},
            {text: 'Asking about prior experiences with decision making',             value: 2},
            {text: 'Disclosing to the patient what you would do if you were him/her', value: 3},
            {text: 'Building client self esteem',                                     value: 4},
        ],
    });

    API.addQuestionsSet('first_step_pregnant', {
        inherit: 'singleChoice',
        name:    'first_step_pregnant',
        stem:    'What is the best first step to providing patient centered genetic counseling to a pregnant patient who comes to you for prenatal genetic testing?',
        answers: [
            {text: 'Ensuring patient understands that screening blood tests are not 100% accurate', value: 1},
            {text: 'Exploring the patient’s needs, values and desires for information',             value: 2},
            {text: 'Ask the patient whether she would terminate a pregnancy if affected with a genetic condition',value: 3},
            {text: 'Discuss the timing of when screening and diagnostic testing can be performed',  value: 4},
        ],
    });

    API.addQuestionsSet('exploring_desires', {
        inherit: 'singleChoice',
        name:    'exploring_desires',
        stem:    'Why is exploring patients’ desires, needs and values important in genetic counseling?',
        answers: [
            {text: 'Depending on clinical circumstances, genetic testing may be optional', value: 1},
            {text: 'The benefits and risks of genetic testing may depend upon unique aspects of an individual', value: 2},
            {text: 'Risks and benefits are weighed differently by individuals',            value: 3},
            {text: 'All of the above',                                                     value: 4},
        ],
    });

    API.addQuestionsSet('pregnant_patient', {
        inherit: 'singleChoice',
        name:    'pregnant_patient',
        stem:    'A 12-week pregnant patient desires genetic testing because she is 39 years old and is concerned about the increased risk for chromosome abnormalities. What testing would you recommend?',
        answers: [
            {text: 'Invasive testing (CVS or amniocentesis) because it will provide the most accurate information', value: 1},
            {text: 'A screening test, such as non-invasive prenatal screening, because it will not pose a risk to her pregnancy', value: 2},
            {text: 'I would not recommend any testing to the patient unless she would terminate an affected pregnancy', value: 3},
            {text: 'I would first explore the patient’s goals for testing in order to help her determine which test, if any, would be helpful to her', value: 4},
        ],
    });

    API.addQuestionsSet('implicit_bias', {
        inherit: 'singleChoice',
        name:    'implicit_bias',
        stem:    'Which of the following is true regarding the role implicit bias can play in healthcare?',
        answers: [
            {text: 'It is insurmountable and is always acted upon by the provider', value: 1},
            {text: 'It can impact provider-patient relationships',                  value: 2},
            {text: 'It is not relevant to clinical practice',                       value: 3},
            {text: 'It does not impact patient health outcomes',                    value: 4},
        ],
    });

    API.addQuestionsSet('iat_measure', {
        inherit: 'singleChoice',
        name:    'iat_measure',
        stem:    'What does the Implicit Association test measure?',
        answers: [
            {text: 'Attitudes and beliefs that people may be unwilling or unable to report', value: 1},
            {text: 'Conscious attitudes and beliefs about a person or group',                value: 2},
            {text: 'Prejudice or unjust treatment of a person or group',                     value: 3},
            {text: 'All of the above',                                                       value: 4},
        ],
    });

    API.addQuestionsSet('not_in_iat', {
        inherit: 'singleChoice',
        name:    'not_in_iat',
        stem:    'Which of the following is not an element of the Implicit Association Test that is used for scoring?',
        answers: [
            {text: 'Reaction time to sorting the words',                                  value: 1},
            {text: 'Correctly sorting the words',                                         value: 2},
            {text: 'Providing additional practice when the category associations change', value: 3},
            {text: 'Scores on explicit bias testing',                                     value: 4},
        ],
    });

    API.addQuestionsSet('iat_validated', {
        inherit: 'singleChoice',
        name:    'iat_validated',
        stem:    'Which of the following is a true statement?',
        answers: [
            {text: 'Implicit Association Test scores predict behavior', value: 1},
            {text: 'Implicit Association Tests are only applicable in the setting of genetic prenatal counseling', value: 2},
            {text: 'The Implicit Association Test is a validated tool that can promote introspection and possible behavior modification', value: 3},
            {text: 'Implicit Association Test scores always correlate with explicit bias', value: 4},
        ],
    });

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
            questions: [
                {inherit: 'autonomous_patient_decisions'}
            ]
        },
        {
            inherit: 'basicPage',
            questions: [
                {inherit: 'first_step_pregnant'}
            ]
        },
        {
            inherit: 'basicPage',
            questions: [
                {inherit: 'exploring_desires'}
            ]
        },
        {
            inherit: 'basicPage',
            questions: [
                {inherit: 'pregnant_patient'}
            ]
        },
        {
            inherit: 'basicPage',
            questions: [
                {inherit: 'implicit_bias'}
            ]
        },
        {
            inherit: 'basicPage',
            questions: [{inherit: 'iat_measure'}]
        },
        {
            inherit: 'basicPage',
            questions: [{inherit: 'not_in_iat'}]
        },
        {
            inherit: 'basicPage',
            questions: [{inherit: 'iat_validated'}]
        },
        {
            inherit: 'basicPage',
            questions: [{inherit: 'email'}]
        },
    ]);

    return API.script;
});
