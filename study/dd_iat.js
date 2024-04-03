define(['pipAPI','minno-tasks/stiat/stiat6.js?' + Math.random()], function(APIConstructor, stiatExtension){
  var API    = new APIConstructor();
  var global = API.getGlobal();


  return stiatExtension(
    {
      remindErrorText: '<p align="center" style="font-size:"4em"; font-family:arial">' +
      'If you make a mistake, a red <font color="#ff0000"><b>X</b></font> will appear. ' +
      'Press the other key to continue.<p/>',
      // Define the category.
      category:
      {
        name: global.idLabel, // Category label.
        title: {
          media: {word: global.idLabel}, // Name of the category presented in the task.
          css: {color:'#31940F','font-size':'2.3em'}, // Style of the category title.
          height: 4 // Used to position the "Or" in the combined block.
        },
        media: [ // Stimuli
          {word: global.intellectually_disabled_words[0]},
          {word: global.intellectually_disabled_words[1]},
          {word: global.intellectually_disabled_words[2]},
          {word: global.intellectually_disabled_words[3]},
          {word: global.intellectually_disabled_words[4]},
        ],
        // Can change color and size of the targets here.
        css: {color:'#0000FF','font-size': '2.3em'},
      },
      attribute1:
      {
        name: 'Bad', // Attribute label
        title: {
          media: {word: 'Bad'},
                css: {color:'#0000FF','font-size':'2.3em'},
                height: 4 // Used to position the "Or" in the combined block.
        },
        media: [ // Stimuli
          {word: global.negWords[0]},
          {word: global.negWords[1]},
          {word: global.negWords[2]},
          {word: global.negWords[3]},
          {word: global.negWords[4]},
          {word: global.negWords[5]},
          {word: global.negWords[6]},
          {word: global.negWords[7]},
        ],
        // Can change color and size of the targets here.
        css: {color:'#0000FF','font-size':'2.3em'},
      },
      attribute2:
      {
        name: 'Good', // Attribute label
        title: {
          media: {word: 'Good'}, // Name of the category presented in the task.
          css: {color:'#0000FF','font-size':'1.8em'},
                height: 4 // Used to position the "Or" in combined block.
        },
        media: [ // Stimuli
          {word: global.posWords[0]},
          {word: global.posWords[1]},
          {word: global.posWords[2]},
          {word: global.posWords[3]},
          {word: global.posWords[4]},
          {word: global.posWords[5]},
          {word: global.posWords[6]},
          {word: global.posWords[7]},
        ],
        // Can change color and size of the targets here.
        css: {color:'#0000FF','font-size':'2.3em'},
      }
    }
  );
});








