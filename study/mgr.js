define(['managerAPI'], function(Manager) {
    var API = new Manager();

    API.setName('mgr');

    API.addSettings('skip', true);

    API.addSettings('skin', 'simple');

    var mediaURL = './study/media/';  // where the images are stored on the server
    var timeURL  = 'minno-time/dist/js';

    API.addGlobal({
        id_iat: {},
        pd_iat: {},

        mediaURL:     mediaURL,
        idLabel:      'Intellectually disabled',
        pdLabel:      'Physically disabled',
        ableLabel:    'Abled persons',
        disableLabel: 'Disabled persons',

        posWords:  API.shuffle([
            'Lovely',
            'Fabulous',
            'Attractive',
            'Friend',
            'Fantastic',
            'Friendship',
            'Cherish',
            'Magnificent',
        ]),
        negWords: API.shuffle([
            'Horrible',
            'Hate',
            'Poison',
            'Yucky',
            'Bothersome',
            'Angry',
            'Abuse',
            'Disaster',
        ]),
        disabledImages: API.shuffle([
           mediaURL + 'disabled1.png',
           mediaURL + 'disabled2.png',
           mediaURL + 'disabled3.png',
           mediaURL + 'disabled4.png',
           mediaURL + 'disabled5.png',
           mediaURL + 'disabled6.png',
        ]),
        abledImages: API.shuffle([
           mediaURL + 'abled1.png',
           mediaURL + 'abled2.png',
           mediaURL + 'abled3.png',
           mediaURL + 'abled4.png',
           mediaURL + 'abled5.png',
           mediaURL + 'abled6.png',
        ]),
        intellectually_disabled_words : API.shuffle([
          'Impairment ',
          'Learning Disability',
          'Developmental Disability',
          'Special Needs',
          'Autism',
        ]),
    });

    // List of segments of process. Actual ordering and calls are below in `addSequence()`
    API.addTasksSet({
        name: 'myTasks',

        instructions: [{
            type:       'message',
            buttonText: 'Continue',
        }],

        question: [{
          type:       'quest',
          piTemplate: true,
        }],

        iat: [{
          baseUrl:   timeURL,
          type:      'pip',
          version:   0.3,
        }],

        results: [{
           type:        'message',
           piTemplate:  true,
           buttonHide:  true,
           last:        true,
        }],

        id_iat_instructions: [{
            inherit:     'instructions',
            name:        'id_iat_instructions',
            templateUrl: 'id_iat_instructions.jst?' + Math.random(),
            title:       'The Implicit Association Test',
            header:      'The Implicit Association Test',
        }],

        id_iat: [{
            inherit:   'iat',
            name:      'id_iat',
            scriptUrl: 'id_iat.js?' + Math.random(),
        }],

        pd_iat_instructions: [{
            inherit:     'instructions',
            name:        'pd_iat_instructions',
            templateUrl: 'pd_iat_instructions.jst?' + Math.random(),
            title:       'The Implicit Association Test',
            piTemplate:  true,
            header:      'The Implicit Association Test',
        }],

        pd_iat: [{
            inherit:   'iat',
            name:      'pd_iat',
            scriptUrl: 'pd_iat.js?' + Math.random(),
        }],

        collect_iat_feedback: [{ // Get summarized iat feedback that was given to user, along with uuid.
          type: 'post',
          url:  'iat_feedback_csv.php',
          data: { header: 'uuid, pd_iat, id_iat',
                  uuid: '<%= redcap_uuid %>',
                  pd_iat: '<%= global.pd_iat.feedback %>',
                  id_iat: '<%= global.id_iat.feedback %>',
                },
        }],

        iat_results: [{
            inherit:     'results',
            name:        'iat_results',
            templateUrl: 'iat_results.jst?' + Math.random(),
            title:       'Final results',
            header:      'You have completed the study'
        }],

        iat_explanation: [{
            inherit:     'results',
            name:        'iat_explanation',
            templateUrl: 'iat_explanation.jst?' + Math.random(),
            title:       'About the IAT',
            header:      'About the IAT'
        }],

        welcome: [{
            inherit:     'instructions',
            name:        'welcom',
            templateUrl: 'welcome.jst?' + Math.random(),
            title:       'Welcome to Inclusive Genetics',
            header:      'Welcome to Inclusive Genetics',
        }],
    });


    API.addSequence([
        // Each set of curly braces is a page.
        {inherit: 'welcome'},

        // First IAT, for physical disabilities
        {inherit: 'pd_iat_instructions'},
        {inherit: 'pd_iat'},

        // Second IAT, for intellectual disabilities
        {inherit: 'id_iat_instructions'},
        {inherit: 'id_iat'},

        {inherit: 'collect_iat_feedback'}, // Collect this immediately after IATs.

        {inherit: 'iat_explanation'},

        // {inherit: 'thanks'},
      ]);
    return API.script;
});
