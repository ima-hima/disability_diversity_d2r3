define(['questAPI'], function(Quest){
    var API = new Quest();

    API.addSequence([
        { // page begins
            header: 'Identification for CEU credits',
            questions: [
                { // first name
                    name: 'first_name',
                    type: 'text',
                    stem: 'First name',
                    required: true,
                    errorMsg: {
                        required: 'You must provide this information in order for us to grant CEU credit. All of your results will remain confidential.'
                    }

                },
                { // last name
                    name: 'last_name',
                    type: 'text',
                    stem: 'Last name',
                    required: true,
                    errorMsg: {
                        required: 'You must provide this information in order for us to grant CEU credit. All of your results will remain confidential.'
                    }

                },
            ] // end questions
        } // page ends
    ]);

    return API.script;
});
