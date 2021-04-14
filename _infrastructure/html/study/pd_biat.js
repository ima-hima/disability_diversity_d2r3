define(['pipAPI', './js/biat_lib.js?' + Math.random()], function(APIConstructor, batExtension){
  var API    = new APIConstructor();
  var global = API.getGlobal();

  return batExtension({
    categories : [
      {
        name : global.pdLabel,
        title : {
          media : {word : global.ableLabel}, //Name of the category presented in the task.
          size : {height: 475, width : 700},
          css : {color:'#31b404','font-size':'2em'}, //Style of the category title.
          height : 8, //Used to position the "Or" in the combined block.
          startStimulus : {
            media : {image : global.mediaURL + 'ableds_sm.png'},
            css : {color:'#31b404','font-size':'1em'},
            height : 13
          }
        },
        stimulusMedia : [ //Stimuli content as PIP's media objects
          {image: global.abledImages[0]},
          {image: global.abledImages[1]},
          {image: global.abledImages[2]},
          {image: global.abledImages[3]},
        ],
        //Stimulus css
        stimulusCss : {color:'#33FF33','font-size':'2em'}
      },
      {
        name : global.pdLabel, //Category label.
        title : {
          media : {word : global.pdLabel},
          css : {color:'#31b404','font-size':'2em'},
          height : 8,
          startStimulus : {
            media : {image : global.mediaURL + 'disableds_sm.png'},
            css : {color:'#31b404','font-size':'1em'},
            height : 13
          }
        },
        stimulusMedia : [ //Stimuli content as PIP's media objects
          {image: global.disabledImages[0]},
          {image: global.disabledImages[1]},
          {image: global.disabledImages[2]},
          {image: global.disabledImages[3]},
        ],
        //Stimulus css
        stimulusCss : {color:'#31b404','font-size':'2em',}
      }
    ],
    attribute1 : {
            name : 'Bad',
            title : {
                media : {word : 'Bad'},
                css : {color:'#0000FF','font-size':'2em'},
                height : 0, //Used to position the "Or" in the combined block.
                startStimulus : {
                  media : {word : global.negWords.join(', ') },
                },
            },
            stimulusMedia : [ //Stimuli content as PIP's media objects
                {word: global.negWords[0]},
                {word: global.negWords[1]},
                {word: global.negWords[2]},
                {word: global.negWords[3]},
                {word: global.negWords[4]},
                {word: global.negWords[5]},
                {word: global.negWords[6]},
                {word: global.negWords[7]}
            ],
            //Stimulus css
            stimulusCss : {color:'#0000FF','font-size':'2.3em'}
        },
        attribute2 : {
            name : 'Good',
            title : {
                media : {word : 'Good'},
                css : {color:'#0000FF','font-size':'2em','margin-top':'9em'},
                height : 6, //Used to position the "Or" in the combined block.
                startStimulus : {
                  media : {word : global.posWords.join(', ') },
                },
            },
            stimulusMedia : [ //Stimuli content as PIP's media objects
                {word: global.posWords[0]},
                {word: global.posWords[1]},
                {word: global.posWords[2]},
                {word: global.posWords[3]},
                {word: global.posWords[4]},
                {word: global.posWords[5]},
                {word: global.posWords[6]},
                {word: global.posWords[7]}
            ],
            //Stimulus css
            stimulusCss : {color:'#0000FF','font-size':'2.3em'}
        },

    practiceBlock : false,
    base_url : {//Where are your images?
      image : '',
    }
  });
});


