define(['pipAPI','minno-tasks/IAT/iat6.js'], function(APIConstructor, iatExtension){
    var API    = new APIConstructor();
    var global = API.getGlobal();

    return iatExtension({
        category1 : {
            name : global.ableLabel, //Will appear in the data.
            title : {
                media : {word : global.ableLabel}, //Name of the category presented in the task.
                css : {color:'#31940F','font-size':'1.8em'}, //Style of the category title.
                height : 4 //Used to position the "Or" in the combined block.
            },
            stimulusMedia : [ //Stimuli content as PIP's media objects
                {image: global.abledImages[0]},
                {image: global.abledImages[1]},
                {image: global.abledImages[2]},
                {image: global.abledImages[3]},
            ],
            //Stimulus css (style)
            stimulusCss : {color:'#31940F','font-size':'2.3em'}
        },
        category2 : {
            name : global.pdLabel, //Will appear in the data.
            title : {
                media : {word : global.pdLabel}, //Name of the category presented in the task.
                css : {color:'#31940F','font-size':'1.8em'}, //Style of the category title.
                height : 4 //Used to position the "Or" in the combined block.
            },
            stimulusMedia : [ //Stimuli content as PIP's media objects
                {image: global.disabledImages[0]},
                {image: global.disabledImages[1]},
                {image: global.disabledImages[2]},
                {image: global.disabledImages[3]},
            ],
            //Stimulus css (style)
            stimulusCss : {
                           color:      '#31940F',
                          'font-size': '2.3em'
                          }
        },
        attribute1 : {
            name : 'Bad',
            title : {
                media: {word: 'Bad'},
                css:   {
                         color:
                         '#0000FF',
                         'font-size': '1.8em'
                        },
                height: 4 //Used to position the "Or" in the combined block.
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
                css :   {color:'#0000FF','font-size':'1.8em'},
                height : 4 //Used to position the "Or" in the combined block.
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
        base_url : { // Where are your images?
            image : global.baseURL
        },
        isTouch : global.isTouch
    });
});

