define(['managerAPI'], function(Manager) {
    var API = new Manager();

    API.setName('mgr');

    API.addSettings('skip', true);

    API.addSettings('skin', 'simple');

    var mediaURL = './study/media/';  // where the images are stored on the server
    var timeURL  = 'minno-time/dist/js';

    API.addGlobal({
        dd_iat: {},
        pd_iat: {},

        mediaURL: mediaURL,
        idLabel: 'Developmentally disabled',
        pdLabel: 'Disabled person',
        ableLabel: 'Abled person',
        disableLabel: 'Disabled person',

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
          'Impairment',
          'Learning Disability',
          'Neurodivergent',
          'Special Needs',
          'Autism',
        ]),
    });

    // List of segments of process. Actual ordering and calls are below in `addSequence()`
    API.addTasksSet({
        name: 'myTasks',

        instructions: [{
            type: 'message',
            buttonText: 'Continue',
        }],

        touch_warning: [{
          type: 'message',
          templateUrl: 'touch_warning.jst?' + Math.random(),
          title: 'D2R3',
        }],

        question: [{
          type: 'quest',
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

        dd_iat_instructions: [{
            inherit:     'instructions',
            name:        'dd_iat_instructions',
            templateUrl: 'dd_iat_instructions.jst?' + Math.random(),
            title:       'The Implicit Association Test',
            header:      'The Implicit Association Test',
        }],

        dd_iat: [{
            inherit:   'iat',
            name:      'dd_iat',
            scriptUrl: 'dd_iat.js?' + Math.random(),
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

        collect_pd_iat_feedback: [{ // Get summarized iat feedback that was given to user, along with uid.
          type: 'post',
          url:  'iat_feedback_api.php',
          data: { header: 'uid, iat_feedback',
                  contents: '<%= redcap_uid %>, <%= global.pd_iat.feedback %>'
                },
        }],

        collect_dd_iat_feedback: [{ // Get summarized iat feedback that was given to user, along with uid.
          type: 'post',
          url:  'iat_feedback_api.php',
          data: { header: 'uid, iat_feedback',
                  contents: '<%= redcap_uid %>, <%= global.dd_iat.feedback %>'
                },
        }],

        redirect_script: [{
          type:'redirect',
          url: redirect_url
        }]
    });


    API.addSequence([
        // Each set of curly braces is a page.
        { inherit: 'touch_warning'},
        {
          mixer: 'branch',
          conditions: [
             {compare: 1, to: which_iat},
          ],
          data: [
            // IAT for physical disabilities
            {inherit: 'pd_iat_instructions'},
            {inherit: 'pd_iat'},
            {inherit: 'collect_pd_iat_feedback'},
          ],
          elseData: [
            // IAT for intellectual disabilities
            {inherit: 'dd_iat_instructions'},
            {inherit: 'dd_iat'},
            {inherit: 'collect_dd_iat_feedback'},
          ],
        },
        {inherit: 'redirect_script'}
      ]);
    return API.script;
});
