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
        decline:     true,
        declineText: isTouch ? 'Decline'
                             : 'Decline to Answer',
        autoFocus:   true,
        header:      'Part II of V: Demographics',
        numbered:    false,
        progressBar: isTouch ? 'Page <%= pagesMeta.number %> out of 13'
                             : 'Page <%= pagesMeta.number %> out of 13',
        prev:        true,
    });

    /**
     * Question prototypes
     */
    API.addQuestionsSet('basicQ', {
        decline:   true,
        required : true,
        errorMsg: {
            required: isTouch
                ? 'Please select an answer, or click \'Decline\''
                : 'Please select an answer, or click \'Decline to Answer\''
        },
        autoSubmit:    true,
        numericValues: true,
    });

    API.addQuestionsSet('singleChoice', {
        inherit:  'basicQ',
        type:     'selectOne',
        help:     '<%= pagesMeta.number < 10 %>',
        helpText: 'Tip: For quick response, click to select your answer, and then click again to submit.',
    });

    API.addQuestionsSet('explicitBiasChoice', {
        inherit:    'singleChoice',
        autoSubmit: false,
        decline:    false,
        errorMsg: {
            required: isTouch
                ? 'Please select an answer.'
                : 'Please select an answer.'
        },
        // helpText:   '',
    });

    API.addQuestionsSet('text', {
        inherit: 'basicQ',
        type:    'text',
        noSubmit: false,
    });

    API.addQuestionsSet('singleChoicedrop', {
        inherit:    'basicQ',
        autoSubmit: false,
        type:       'dropdown',
    });

    API.addQuestionsSet('multiChoice', {
        inherit: 'basicQ',
        type:    'selectMulti',
    });

    API.addQuestionsSet('boolean', {
        inherit:  'basicQ',
        type:     'selectOne',
        buttons:  true,
        answers : [
            {text: 'Yes', value:1},
            {text: 'No',  value:0},
        ]
    });

    /**
     * Questions
     */
    API.addQuestionsSet('age', {
        inherit: 'singleChoicedrop',
        name:    'age',
        stem:    'What is your age?',
        answers: _.range(100, 15, -1), // use underscore to create an array of years from ten years ago back to 1910
    });

    API.addQuestionsSet('genderIdentity', {
        inherit: 'singleChoice',
        name:    'genderIdentity',
        stem:    'What is your current gender identity?',
        answers: [
            {text: 'Male',                 value: 1},
            {text: 'Female',               value: 2},
            {text: 'Nonbinary',            value: 3},
            {text: 'Prefer not to answer', value: 4},
        ]
    });

    API.addQuestionsSet('work_setting', {
        inherit: 'singleChoice',
        name:    'work_setting',
        stem:    'What is your work setting?',
        answers: [
            {text: 'Clinical laboratory',     value: 1},
            {text: 'Clinical patient-facing', value: 2},
            {text: 'Research',                value: 3},
            {text: 'Other',                   value: 4},
        ]
    });

    API.addQuestionsSet('clinical_setting', {
        inherit: 'singleChoice',
        name:    'clinical_setting',
        stem:    'What is your role in a clinical setting?',
        answers: [
            {text: 'N/A',                     value: 1},
            {text: 'MD (medical geneticist)', value: 2},
            {text: 'MD (other)',              value: 3},
            {text: 'Genetic counselor',       value: 4},
            {text: 'Nurse',                   value: 5},
            {text: 'Other allied health professional', value: 6},
            {text: 'Resident',                value: 7},
            {text: 'Medical student (preclinical)',    value: 8},
            {text: 'Medical student (clinical)',       value: 9},
            {text: 'Fellow',                  value: 10},
            {text: 'GC student',              value: 11},
            {text: 'Educator',                value: 12},
            {text: 'Other',                   value: 13},
        ]
    });

    API.addQuestionsSet('state', {
        inherit: 'singleChoicedrop',
        name: 'state',
        stem: 'What is your state of residence?',
        answers: [
            {text: 'Alabama (AL)',                        }, //value: 1},
            {text: 'Alaska (AK)',                         }, //value: 2},
            {text: 'Arizona (AZ)',                        }, //value: 3},
            {text: 'Arkansas (AR)',                       }, //value: 4},
            {text: 'California (CA)',                     }, //value: 5},
            {text: 'Colorado (CO)',                       }, //value: 6},
            {text: 'Connecticut (CT)',                    }, //value: 7},
            {text: 'Delaware (DE)',                       }, //value: 8},
            {text: 'Florida (FL)',                        }, //value: 9},
            {text: 'Georgia (GA)',                        }, //value: 10},
            {text: 'Hawaii (HI)',                         }, //value: 11},
            {text: 'Idaho (ID)',                          }, //value: 12},
            {text: 'Illinois (IL)',                       }, //value: 13},
            {text: 'Indiana (IN)',                        }, //value: 14},
            {text: 'Iowa (IA)',                           }, //value: 15},
            {text: 'Kansas (KS)',                         }, //value: 16},
            {text: 'Kentucky (KY)',                       }, //value: 17},
            {text: 'Louisiana (LA)',                      }, //value: 18},
            {text: 'Maine (ME)',                          }, //value: 19},
            {text: 'Maryland (MD)',                       }, //value: 20},
            {text: 'Massachusetts (MA)',                  }, //value: 21},
            {text: 'Michigan (MI)',                       }, //value: 22},
            {text: 'Minnesota (MN)',                      }, //value: 23},
            {text: 'Mississippi (MS)',                    }, //value: 24},
            {text: 'Missouri (MO)',                       }, //value: 25},
            {text: 'Montana (MT)',                        }, //value: 26},
            {text: 'Nebraska (NE)',                       }, //value: 27},
            {text: 'Nevada (NV)',                         }, //value: 28},
            {text: 'New Hampshire (NH)',                  }, //value: 29},
            {text: 'New Jersey (NJ)',                     }, //value: 30},
            {text: 'New Mexico (NM)',                     }, //value: 31},
            {text: 'New York (NY)',                       }, //value: 32},
            {text: 'North Carolina (NC)',                 }, //value: 33},
            {text: 'North Dakota (ND)',                   }, //value: 34},
            {text: 'Ohio (OH)',                           }, //value: 35},
            {text: 'Oklahoma (OK)',                       }, //value: 36},
            {text: 'Oregon (OR)',                         }, //value: 37},
            {text: 'Pennsylvania (PA)',                   }, //value: 38},
            {text: 'Rhode Island (RI)',                   }, //value: 39},
            {text: 'South Carolina (SC)',                 }, //value: 40},
            {text: 'South Dakota (SD)',                   }, //value: 41},
            {text: 'Tennessee (TN)',                      }, //value: 42},
            {text: 'Texas (TX)',                          }, //value: 43},
            {text: 'Utah (UT)',                           }, //value: 44},
            {text: 'Vermont (VT)',                        }, //value: 45},
            {text: 'Virginia (VA)',                       }, //value: 46},
            {text: 'Washington (WA)',                     }, //value: 47},
            {text: 'West Virginia (WV)',                  }, //value: 48},
            {text: 'Wisconsin (WI)',                      }, //value: 49},
            {text: 'Wyoming (WY)',                        }, //value: 50},
            {text: 'American Samoa (AS)',                 }, //value: 51},
            {text: 'District of Columbia (DC)',           }, //value: 52},
            {text: 'Federated States of Micronesia (FM)', }, //value: 53},
            {text: 'Guam (GU)',                           }, //value: 54},
            {text: 'Marshall Islands (MH)',               }, //value: 55},
            {text: 'Northern Mariana Islands (MP)',       }, //value: 56},
            {text: 'Palau (PW)',                          }, //value: 57},
            {text: 'Puerto Rico (PR)',                    }, //value: 58},
            {text: 'Virgin Islands (VI)',                 }, //value: 59},
            {text: 'Armed Forces Africa (AE)',            }, //value: 60},
            {text: 'Armed Forces Americas (AA)',          }, //value: 61},
            {text: 'Armed Forces Canada (AE)',            }, //value: 62},
            {text: 'Armed Forces Europe (AE)',            }, //value: 63},
            {text: 'Armed Forces Middle East (AE)',       }, //value: 64},
            {text: 'Armed Forces Pacific (AP)',           }, //value: 65},
        ]
    });

    API.addQuestionsSet('religionid', {
        inherit: 'singleChoice',
        name:    'religionid',
        stem:    'How religious do you consider yourself to be?',
        answers: [
            {text: 'Very religious',       value: 1},
            {text: 'Somewhat religious',   value: 2},
            {text: 'Not very religious',   value: 3},
            {text: 'Not at all religious', value: 4},
        ]
    });

    API.addQuestionsSet('politicalid', {
        inherit: 'singleChoice',
        name:    'politicalid',
        stem:    'What is your political identity?',
        answers: [
            {text: 'Very Conservative', value: 1},
            {text: 'Conservative',      value: 2},
            {text: 'Moderate',          value: 3},
            {text: 'Liberal',           value: 4},
            {text: 'Very Liberal',      value: 5},
            {text: 'Other',             value: 6},
        ]
    });

    API.addQuestionsSet('termination', {
        inherit: 'singleChoice',
        name:    'termination',
        stem:    'What is your stance on termination of pregnacy?',
        answers: [
            {text: 'Very Pro Choice (termination is acceptable for any reason)',       value: 1},
            {text: 'Somewhat Pro Choice (termination is acceptable for some reasons)', value: 2},
            {text: 'Neutral (not pro-choice or pro-life)',                             value: 3},
            {text: 'Somewhat Pro-Life (termination is not acceptable except in rare exceptions)', value: 4},
            {text: 'Very Pro-Life (termination is not acceptable for any reason)',     value: 5},
        ]
    });

    API.addQuestionsSet('clinical_experience', {
        inherit: 'singleChoice',
        name:    'clinical_experience',
        stem:    'Please describe your level of clinical experience counseling pregnant patients about prenatal genetic testing.',
        answers: [
            {text: 'Very experienced',       value: 1},
            {text: 'Somewhat experienced',   value: 2},
            {text: 'Not very experienced',   value: 3},
            {text: 'Not at all experienced', value: 4},
        ]
    });

    API.addQuestionsSet('intellectual_disability_experience', {
        inherit: 'multiChoice',
        name:    'intellectual_disability_experience',
        stem:    'Please select relevant experiences you have had with someone with an <strong>intellectual disability (ID)</strong>. Multiple choices are allowed.',
        answers: [
            {text: 'Personal history of ID',              value: 1},
            {text: 'Family member with ID',               value: 2},
            {text: 'Friend with ID',                      value: 3},
            {text: 'Volunteer with individuals with ID',  value: 4},
            {text: 'Professional experiences',            value: 5},
            {text: 'Experiences during medical training', value: 6},
            {text: 'None',  value: 7},
            {text: 'Other', value: 8},
        ]
    });

    API.addQuestionsSet('physical_disability_experience', {
        inherit: 'multiChoice',
        name: 'physical_disability_experience',
        stem: 'Please select relevant experiences you have had with someone with a <strong>physical disability (PD)</strong>. Multiple choices are allowed.',
        answers: [
            {text: 'Personal history of PD',              value: 1},
            {text: 'Family member with PD',               value: 2},
            {text: 'Friend with PD',                      value: 3},
            {text: 'Volunteer with individuals with PD',  value: 4},
            {text: 'Professional experiences',            value: 5},
            {text: 'Experiences during medical training', value: 6},
            {text: 'None',  value: 7},
            {text: 'Other', value: 8},
        ]
    });


//// Start Explicit Bias questions here. ////

    API.addQuestionsSet('PD_uncomfortable', {
        inherit: 'explicitBiasChoice',
        name: 'PD_uncomfortable',
        stem: 'Most people are uncomfortable around a child with a <em>physical disability</em>.',
        answers: [
            {text: 'Strongly disagree', value: 1},
            {text: 'Disagree',          value: 2},
            {text: 'Neutral',           value: 3},
            {text: 'Agree',             value: 4},
            {text: 'Strongly agree',    value: 5},
        ]
    });

    API.addQuestionsSet('PD_ignored', {
        inherit: 'explicitBiasChoice',
        name: 'PD_ignored',
        stem: 'The good characteristics of a child with a <em>physical disability</em> tend to be ignored.',
        answers: [
            {text: 'Strongly disagree', value: 1},
            {text: 'Disagree',          value: 2},
            {text: 'Neutral',           value: 3},
            {text: 'Agree',             value: 4},
            {text: 'Strongly agree',    value: 5},
        ]
    });

    API.addQuestionsSet('PD_impairment', {
        inherit: 'explicitBiasChoice',
        name: 'PD_impairment',
        stem: 'Most children with a <em>physical disability</em> are extremely impaired and cannot live independently as adults.',
        answers: [
            {text: 'Strongly disagree', value: 1},
            {text: 'Disagree',          value: 2},
            {text: 'Neutral',           value: 3},
            {text: 'Agree',             value: 4},
            {text: 'Strongly agree',    value: 5},
        ]
    });

    API.addQuestionsSet('PD_outcasts', {
        inherit: 'explicitBiasChoice',
        name: 'PD_outcasts',
        stem: 'People with <em>physical disabilities</em> are often treated as outcasts.',
        answers: [
            {text: 'Strongly disagree', value: 1},
            {text: 'Disagree',          value: 2},
            {text: 'Neutral',           value: 3},
            {text: 'Agree',             value: 4},
            {text: 'Strongly agree',    value: 5},
        ]
     });

     API.addQuestionsSet('PD_undesirable', {
        inherit: 'explicitBiasChoice',
        name: 'PD_undesirable',
        stem: 'Most people feel that having a child with a <em>physical disability</em> is undesirable.',
        answers: [
            {text: 'Strongly disagree', value: 1},
            {text: 'Disagree',          value: 2},
            {text: 'Neutral',           value: 3},
            {text: 'Agree',             value: 4},
            {text: 'Strongly agree',    value: 5},
        ]
    });

    API.addQuestionsSet('ID_uncomfortable', {
        inherit: 'explicitBiasChoice',
        name: 'ID_uncomfortable',
        stem: 'Most people are uncomfortable around a child with an <em>intellectual disability</em>.',
        answers: [
            {text: 'Strongly disagree', value: 1},
            {text: 'Disagree',          value: 2},
            {text: 'Neutral',           value: 3},
            {text: 'Agree',             value: 4},
            {text: 'Strongly agree',    value: 5},
        ]
    });

    API.addQuestionsSet('ID_ignored', {
        inherit: 'explicitBiasChoice',
        name: 'ID_ignored',
        stem: 'The good characteristics of a child with an <em>intellectual disability</em> tend to be ignored.',
        answers: [
            {text: 'Strongly disagree', value: 1},
            {text: 'Disagree',          value: 2},
            {text: 'Neutral',           value: 3},
            {text: 'Agree',             value: 4},
            {text: 'Strongly agree',    value: 5},
        ]
    });

    API.addQuestionsSet('ID_impairment', {
        inherit: 'explicitBiasChoice',
        name: 'ID_impairment',
        stem: 'Most children with an <em>intellectual disability</em> are extremely impaired and cannot live independently as adults.',
        answers: [
            {text: 'Strongly disagree', value: 1},
            {text: 'Disagree',          value: 2},
            {text: 'Neutral',           value: 3},
            {text: 'Agree',             value: 4},
            {text: 'Strongly agree',    value: 5},
        ]
    });

    API.addQuestionsSet('ID_outcasts', {
        inherit: 'explicitBiasChoice',
        name: 'ID_outcasts',
        stem: 'People with <em>intellectual disabilities</em> are often treated as outcasts.',
        answers: [
            {text: 'Strongly disagree', value: 1},
            {text: 'Disagree',          value: 2},
            {text: 'Neutral',           value: 3},
            {text: 'Agree',             value: 4},
            {text: 'Strongly agree',    value: 5},
        ]
    });

    API.addQuestionsSet('ID_undesirable', {
        inherit: 'explicitBiasChoice',
        name: 'ID_undesirable',
        stem: 'Most people feel that having a child with an <em>intellectual disability</em> is undesirable.',
        answers: [
            {text: 'Strongly disagree', value: 1},
            {text: 'Disagree',          value: 2},
            {text: 'Neutral',           value: 3},
            {text: 'Agree',             value: 4},
            {text: 'Strongly agree',    value: 5},
        ]
    });

    API.addSequence([
        {
            inherit: 'basicPage',
            questions: [
                {inherit: 'age'}
            ]
        },
        {
            inherit: 'basicPage',
            questions: [
                {inherit: 'genderIdentity'}
            ]
        },
        {
            inherit: 'basicPage',
            questions: [
                {inherit: 'work_setting'}
            ]
        },
        {
            inherit: 'basicPage',
            questions: [
                {inherit: 'clinical_setting'}
            ]
        },
        {
            inherit: 'basicPage',
            questions: [
                {inherit: 'state'}
            ]
        },
        {
            inherit: 'basicPage',
            questions: [{inherit: 'religionid'}]
        },
        {
            inherit: 'basicPage',
            questions: [{inherit: 'politicalid'}]
        },
        {
            inherit: 'basicPage',
            questions: [{inherit: 'termination'}]
        },
        {
            inherit: 'basicPage',
            questions: [{inherit: 'clinical_experience'}]
        },
        {
            inherit: 'basicPage',
            questions: [{inherit: 'intellectual_disability_experience'}]
        },
        {
            inherit: 'basicPage',
            questions: [{inherit: 'physical_disability_experience'}]
        },
        {
            inherit:   'basicPage',
            questions: [{inherit: 'PD_uncomfortable'},
                        {inherit: 'PD_ignored'},
                        {inherit: 'PD_impairment'},
                        {inherit: 'PD_outcasts'},
                        {inherit: 'PD_undesirable'},
                       ],
            decline:   false,
        },
        {
            inherit:   'basicPage',
            questions: [{inherit: 'ID_uncomfortable'},
                        {inherit: 'ID_ignored'},
                        {inherit: 'ID_impairment'},
                        {inherit: 'ID_outcasts'},
                        {inherit: 'ID_undesirable'},
                       ],
            decline:   false,
        },
    ]);

    return API.script;
});
